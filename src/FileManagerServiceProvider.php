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
//        $this->publishes([
//            __DIR__ . '/../resources/views' => resource_path('views/vendor/application-manager'),
//        ], 'views');
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/file-manager'),
            __DIR__ . '/config/file-manager.php' => config_path('file-manager.php'),
            __DIR__.'/public/css' => public_path('vendor/file-manager/css'),
            __DIR__.'/public/js' => public_path('vendor/file-manager/js'),
            __DIR__.'/public/image' => public_path('vendor/file-manager/image'),
        ], 'file-manager');
    }

    public function register()
    {

    }
}
