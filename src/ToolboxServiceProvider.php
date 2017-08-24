<?php

namespace Hitman\Toolbox;

use Illuminate\Support\ServiceProvider;

class ToolboxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([ __DIR__ . "/config/toolbox.php" => config_path('toolbox.php') ], 'toolbox');
        $this->publishes([__DIR__ . "/assets" => public_path('vendor/toolbox')], 'toolbox');
        $this->publishes([__DIR__ . "/views" => resource_path('views/vendor/toolbox')], 'toolbox');

        // 后台管理模板
        $this->publishes([__DIR__ . "/Controllers/Admin" => app_path("Http/Controllers/Admin")], 'toolbox');
        $this->publishes([__DIR__ . "/routes/admin.php" => base_path('routes/admin.php')], 'toolbox');
        $this->publishes([__DIR__ . "/Models/" => app_path('Models')], 'toolbox');
        $this->publishes([__DIR__ . "/databases/migrations/2017_08_24_080433_create_table_admins.php" => database_path('migrations/2017_08_24_080433_create_table_admins.php')], 'toolbox');
    }
    
    public function register()
    {

    }
}
