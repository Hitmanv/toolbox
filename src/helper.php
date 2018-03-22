<?php

function tb_config_content($config, $intent="\t")
{
    if(!is_array($config)) return $config;

    $content = "[\n";

    foreach($config as $k => $v){
        $content .= "{$k} => " . tb_config_content($v, $intent . $intent) . ",";
    }

    $content .= "]\n";

    return $content;
}
