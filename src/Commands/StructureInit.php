<?php

namespace Hitman\Toolbox\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
require_once __DIR__ . "/../helpers.php";

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
        tb_mkdir(app_path("Models"));
        tb_mkdir(app_path("Traits"));
        copy(__DIR__ . "/../templates/Models/Model.php.template", app_path("Models/Model.php"));
        copy(__DIR__ . "/../templates/Traits/ModelTrait.php.template", app_path("Traits/ModelTrait.php"));

        if ($this->confirm("是否删除示例文件")) {
            $this->deleteFiles();
        }

        if ($this->confirm("是否创建后台管理模板?")) {
            $this->init_admin();
        }
    }

    protected function deleteFiles()
    {
        // 删除部分示例文件
        tb_unlink(app_path('Http/Controllers/Auth/ForgotPasswordController.php'));
        tb_unlink(app_path('Http/Controllers/Auth/LoginController.php'));
        tb_unlink(app_path('Http/Controllers/Auth/RegisterController.php'));
        tb_unlink(app_path('Http/Controllers/Auth/ResetPasswordController.php'));
        tb_rmdir(app_path('Http/Controllers/Auth'));
        tb_unlink(app_path('User.php'));

        tb_unlink(base_path('database/migrations/2014_10_12_000000_create_users_table.php'));
        tb_unlink(base_path('database/migrations/2014_10_12_100000_create_password_resets_table.php'));
    }

    protected function init_admin()
    {
        // Model
        copy(__DIR__ . "/../templates/Models/Admin.php.template", app_path("Models/Admin.php"));
        copy(__DIR__ . "/../databases/migrations/2017_08_24_080433_create_table_admins.php", database_path('migrations/2017_08_24_080433_create_table_admins.php'));
        // Controller
        tb_mkdir(app_path('Http/Controllers/Admin'));
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