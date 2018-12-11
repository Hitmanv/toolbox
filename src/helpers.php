<?php

function tb_is_dir_empty($dir)
{
    if (!is_readable($dir)) return NULL;

    return (count(scandir($dir)) == 2);
}

function tb_write_config($config, $path)
{
    $content = tb_config_content($config);
    $content = "<?php \n" . "return " . $content;

    file_put_contents($path, $content);

    return true;
}

function tb_config_content($config, $intent = "\t")
{
    if (!is_array($config)) return "'{$config}'";

    $content = "[\n";

    foreach ($config as $k => $v) {
        if (tb_is_seq($config)) {
            $content .= $intent . tb_config_content($v, $intent . $intent) . "\n";
        } else {
            $content .= $intent . "'{$k}' => " . tb_config_content($v, $intent . $intent) . ",\n";
        }
    }


    $content .= $intent . "]";

    return $content;
}

function tb_is_seq($arr)
{
    return array_keys($arr) === range(0, count($arr) - 1);
}

function tb_mkdir($path)
{
    if (!is_dir($path)) mkdir($path, 0755, 1);
}

function tb_rmdir($path)
{
    if (is_dir($path) && tb_is_dir_empty($path)) rmdir($path);
}

function tb_unlink($path)
{
    if (is_file($path)) unlink($path);
}