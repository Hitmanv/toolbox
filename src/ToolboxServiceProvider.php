<?php

namespace Hitman\Toolbox;

use Illuminate\Support\ServiceProvider;

class ToolboxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([ __DIR__ . "/config/toolbox.php" => config_path('toolbox.php') ], 'toolbox');
        $this->publishes([__DIR__ . "/assets" => public_path('vendor/toolbox')], 'toolbox');
        $this->publishes([__DIR__ . "/views" => resource_path('views/vendor/toolbox')]);
    }
    
    public function register()
    {

    }
}
