<?php

namespace Hitman\Toolbox;

use Hitman\Toolbox\Commands\DBDocGenerator;
use Hitman\Toolbox\Commands\StructureInit;
use Illuminate\Support\ServiceProvider;

class ToolboxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 后台模板
        $this->publishes([ __DIR__ . "/config/toolbox.php" => config_path('toolbox.php') ], 'tb_admin_asset');
        $this->publishes([ __DIR__ . "/config/sidebar.php" => config_path('sidebar.php') ], 'tb_admin_asset');
        $this->publishes([__DIR__ . "/assets" => public_path('vendor/toolbox')], 'tb_admin_asset');
        $this->publishes([__DIR__ . "/views" => resource_path('views/toolbox')], 'tb_admin_asset');

        // 数据库字典生成
        if($this->app->runningInConsole()) {
            $this->commands(DBDocGenerator::class);
            $this->commands(StructureInit::class);
        }
    }
    
    public function register()
    {

    }
}
