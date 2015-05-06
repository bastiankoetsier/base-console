<?php namespace Bkoetsier\BaseConsole\Providers;

use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Filesystem\Filesystem as LaravelFilesystem;
use Illuminate\Support\ServiceProvider;


class Filesystem extends ServiceProvider{

    public function register()
    {
        $this->app->singleton('files', function() { return new LaravelFilesystem; });
    }
}