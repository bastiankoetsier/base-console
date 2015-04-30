<?php

require_once __DIR__ . '/../../../autoload.php';  // composer dependency


$basePath = realpath(__DIR__ . '/../');
$providersFile = $basePath.DIRECTORY_SEPARATOR.'service_providers.php';
$app = new \Bkoetsier\BaseConsole\Foundation\Container($basePath);

$app->singleton(
    'Illuminate\Contracts\Console\Kernel',
    'Bkoetsier\BaseConsole\Foundation\Kernel'
);

if(file_exists($providersFile))
{
    $providers = require_once $providersFile;
    foreach($providers as $serviceProvider){
        $app->register($serviceProvider);
    }
}

return $app;