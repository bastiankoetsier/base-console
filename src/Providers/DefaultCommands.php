<?php namespace Bkoetsier\BaseConsole\Providers;

use Bkoetsier\BaseConsole\Commands\ProviderMakeCommand;
use Illuminate\Support\ServiceProvider;

class DefaultCommands extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('baseConsole.commands.provider',function($app){
            return $app->make(ProviderMakeCommand::class);
        });

        $this->commands([
            'baseConsole.commands.provider'
        ]);
    }
}