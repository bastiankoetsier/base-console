<?php namespace Bkoetsier\BaseConsole\Foundation;

use Exception;
use RuntimeException;
use Bkoetsier\BaseConsole\Foundation\Application as BaseConsole;
use Illuminate\Contracts\Console\Kernel as KernelContract;

class Kernel implements KernelContract
{

    /**
     * The application implementation.
     *
     * @var \Bkoetsier\BaseConsole\Foundation\Container $container
     */
    protected $container;

    /**
     * The Artisan application instance.
     *
     * @var \Illuminate\Console\Application
     */
    protected $baseConsole;

    /**
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Create a new console kernel instance.
     * @param \Bkoetsier\BaseConsole\Foundation\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Run the console application.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return int
     */
    public function handle($input, $output = null)
    {
        try {
            return $this->getBaseConsole()->run($input, $output);
        } catch (Exception $e) {
            $this->reportException($e);

            $this->renderException($output, $e);

            return 1;
        }
    }


    /**
     * Run an Artisan console command by name.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @return int
     */
    public function call($command, array $parameters = array())
    {
        return $this->getBaseConsole()->call($command, $parameters);
    }

    /**
     * Queue the given console command.
     *
     * @param  string  $command
     * @param  array   $parameters
     * @return void
     */
    public function queue($command, array $parameters = array())
    {
        throw new RuntimeException("Queueing commands is not supported by BaseConsole.");
    }

    /**
     * Get all of the commands registered with the console.
     *
     * @return array
     */
    public function all()
    {
        return $this->getBaseConsole()->all();
    }

    /**
     * Get the output for the last run command.
     *
     * @return string
     */
    public function output()
    {
        return $this->getBaseConsole()->output();
    }

    /**
     * Get the BaseConsole application instance.
     *
     * @return \Bkoetsier\BaseConsole\Foundation\Application
     */
    protected function getBaseConsole()
    {
        if (is_null($this->baseConsole)) {
            return $this->baseConsole = (new BaseConsole($this->container, $this->container->make('events'), $this->container->version()))
                ->resolveCommands($this->getCommands());
        }

        return $this->baseConsole;
    }

    /**
     * Get the commands to add to the application.
     *
     * @return array
     */
    protected function getCommands()
    {
        return $this->commands;
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param  \Exception  $e
     * @return void
     */
    protected function reportException(Exception $e)
    {
        $this->container['Illuminate\Contracts\Debug\ExceptionHandler']->report($e);
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @param  \Exception  $e
     * @return void
     */
    protected function renderException($output, Exception $e)
    {
        $this->container['Illuminate\Contracts\Debug\ExceptionHandler']->renderForConsole($output, $e);
    }
}
