<?php

namespace Hitman\Toolbox;

use Hitman\Toolbox\Commands\DBDocGenerator;
use Illuminate\Support\ServiceProvider;

class ToolboxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 后台模板
        $this->publishes([ __DIR__ . "/config/toolbox.php" => config_path('toolbox.php') ], 'toolbox');
        $this->publishes([__DIR__ . "/assets" => public_path('vendor/toolbox')], 'toolbox');
        $this->publishes([__DIR__ . "/views" => resource_path('views/vendor/toolbox')], 'toolbox');

        // 后台管理员生成
        $this->publishes([__DIR__ . "/config/auth.php" => config_path('auth.php')], 'toolbox');
        $this->publishes([__DIR__ . "/Controllers/Admin/Controller.php.template" => app_path("Http/Controllers/Admin/Controller.php")], 'toolbox');
        $this->publishes([__DIR__ . "/Controllers/Admin/AdminController.php.template" => app_path("Http/Controllers/Admin/AdminController.php")], 'toolbox');
        $this->publishes([__DIR__ . "/routes/web.php" => base_path('routes/web.php')], 'toolbox');
        $this->publishes([__DIR__ . "/Traits/ModelTrait.php.template" => app_path('Traits/ModelTrait.php')], 'toolbox');
        $this->publishes([__DIR__ . "/Models/Model.php.template" => app_path('Models/Model.php')], 'toolbox');
        $this->publishes([__DIR__ . "/Models/Admin.php.template" => app_path('Models/Admin.php')], 'toolbox');
        $this->publishes([__DIR__ . "/databases/migrations/2017_08_24_080433_create_table_admins.php" => database_path('migrations/2017_08_24_080433_create_table_admins.php')], 'toolbox');

        // 数据库字典生成
        if($this->app->runningInConsole()) {
            $this->commands(
                DBDocGenerator::class
            );
        }
    }
    
    public function register()
    {

    }
}
