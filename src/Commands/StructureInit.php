<?php

namespace Hitman\Toolbox\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class StructureInit extends Command
{
    protected $signature = 'tb:init';
    protected $description = '生成项目基本结构';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info("创建 Models 初始文件");
        $this->mkdir(app_path("Models"));
        $this->mkdir(app_path("Traits"));
        copy(__DIR__ . "/../templates/Models/Model.php.template", app_path("Models/Model.php"));
        copy(__DIR__ . "/../templates/Traits/ModelTrait.php.template", app_path("Traits/ModelTrait.php"));

        if ($this->confirm("是否删除示例文件")) {
            $this->deleteFiles();
        }

        if ($this->confirm("是否创建后台管理模板?")) {
            // Model
            copy(__DIR__ . "/../templates/Models/Admin.php.template", app_path("Models/Admin.php"));
            copy(__DIR__ . "/../databases/migrations/2017_08_24_080433_create_table_admins.php", database_path('migrations/2017_08_24_080433_create_table_admins.php'));
            // Controller
            $this->mkdir(app_path('Http/Controllers/Admin'));
            copy(__DIR__ . "/../templates/Controllers/Admin/Controller.php.template", app_path("Http/Controllers/Admin/Controller.php"));
            copy(__DIR__ . "/../templates/Controllers/Admin/AdminController.php.template", app_path("Http/Controllers/Admin/AdminController.php"));
            // auth
            copy(__DIR__ . "/../config/auth.php", config_path("auth.php"));
            // route
            copy(__DIR__ . "/../routes/admin.php", base_path('routes/admin.php'));
            file_put_contents(base_path('routes/web.php'), "// 添加后台路由\nrequire(base_path('routes/admin.php'));\n", FILE_APPEND);
            // views
            Artisan::call("vendor:publish", ['--tag' => 'tb_admin_asset']);
            // middleware
            copy(__DIR__ . "/../templates/Middleware/AdminAuth.php.template", app_path("Http/Middleware/AdminAuth.php"));
            copy(__DIR__ . "/../templates/Middleware/AdminGuest.php.template", app_path("Http/Middleware/AdminGuest.php"));
            copy(__DIR__ . "/../templates/Http_Kernel.php.template", app_path('Http/Kernel.php'));
        }
    }

    protected function deleteFiles()
    {
        // 删除部分示例文件
        $this->unlink(app_path('Http/Controllers/Auth/ForgotPasswordController.php'));
        $this->unlink(app_path('Http/Controllers/Auth/LoginController.php'));
        $this->unlink(app_path('Http/Controllers/Auth/RegisterController.php'));
        $this->unlink(app_path('Http/Controllers/Auth/ResetPasswordController.php'));
        $this->rmdir(app_path('Http/Controllers/Auth'));
        $this->unlink(app_path('User.php'));
    }

    protected function mkdir($path)
    {
        if (!is_dir($path)) mkdir($path, 0755, 1);
    }

    protected function rmdir($path)
    {
        if (is_dir($path) && $this->is_dir_empty($path)) rmdir($path);
    }

    protected function unlink($path)
    {
        if (is_file($path)) unlink($path);
    }

    protected function is_dir_empty($dir)
    {
        if (!is_readable($dir)) return NULL;

        return (count(scandir($dir)) == 2);
    }

    protected function tb_write_config($config, $path)
    {
        $content = $this->tb_config_content($config);
        $content = "<?php \n" . "return " . $content;

        file_put_contents($path, $content);

        return true;
    }

    protected function tb_config_content($config, $intent = "\t")
    {
        if (!is_array($config)) return "'{$config}'";

        $content = "[\n";

        foreach ($config as $k => $v) {
            if ($this->is_seq($config)) {
                $content .= $intent . $this->tb_config_content($v, $intent . $intent) . "\n";
            } else {
                $content .= $intent . "'{$k}' => " . $this->tb_config_content($v, $intent . $intent) . ",\n";
            }
        }


        $content .= $intent . "]";

        return $content;
    }

    protected function is_seq($arr)
    {
        return array_keys($arr) === range(0, count($arr) - 1);
    }

}