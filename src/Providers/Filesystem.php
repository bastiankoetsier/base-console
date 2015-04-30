<?php namespace Bkoetsier\BaseConsole\Providers;

use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Filesystem\Filesystem as LaravelFilesystem;


class Filesystem extends FilesystemServiceProvider{

    public function register()
    {
        $this->app->singleton('files', function() { return new LaravelFilesystem; });
    }
}