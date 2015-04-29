<?php namespace Bkoetsier\BaseConsole\Foundation;

use Illuminate\Console\Application as LaravelConsole;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container as ContainerContract;

class Application extends LaravelConsole
{

    /**
     * Just to set the app-name, thanks taylor :P
     *
     * @param  \Illuminate\Contracts\Container\Container  $laravel
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @param  string  $version
     */
    public function __construct(ContainerContract $laravel, Dispatcher $events, $version)
    {
        parent::__construct($laravel, $events,$version);
        $this->setName('BaseConsole');
    }
}