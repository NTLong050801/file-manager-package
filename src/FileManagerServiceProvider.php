<?php

namespace Ntlong050801\FileManager;

use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views','file-manager');
        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/'),
        ], 'file-manager-views');

        $this->publishes([
            __DIR__ . '/config/file-manager.php' => config_path('file-manager.php'),
        ], 'file-manager-config');

        $this->publishes([
            __DIR__.'/public/css' => public_path('vendor/file-manager/css'),
        ], 'file-manager-css');

        $this->publishes([
            __DIR__.'/public/js' => public_path('vendor/file-manager/js'),
        ], 'file-manager-js');
    }

    public function register()
    {

    }
}
