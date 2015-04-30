<?php

$vendorPath = realpath(__DIR__ . '/../../../');
#$vendorPath = realpath(__DIR__.'/../../vendor');

if( ! $vendorPath)
{
    die('No autoloader configured. Please call composer install');
}
require_once $vendorPath.DIRECTORY_SEPARATOR.'autoload.php';  // composer dependency

$basePath = realpath($vendorPath.'/../');
$providersFile =$basePath.DIRECTORY_SEPARATOR.'service_providers.php';
$app = new \Bkoetsier\BaseConsole\Foundation\Container($basePath);

$app->singleton(
    'Illuminate\Contracts\Console\Kernel',
    'Bkoetsier\BaseConsole\Foundation\Kernel'
);
$app->bind('vendorPath', function($app)use($vendorPath)
{
    return $vendorPath;
});

if(file_exists($providersFile))
{
    $providers = require_once $providersFile;
    foreach($providers as $serviceProvider){
        $app->register($serviceProvider);
    }
}

return $app;