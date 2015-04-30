<?php namespace Bkoetsier\BaseConsole;

use Composer\Script\Event;

class ComposerInit {

    public static function postPackageInstall(Event $event)
    {
        $composer = $event->getComposer();
        $config = $composer->getConfig();
        $vendorDir = $config->get('vendor-dir');
        $baseDir = realpath($vendorDir.'/../');
        $serviceProviderFile = __DIR__.'/../service_providers.php';
        copy($serviceProviderFile,$baseDir.'service_providers.php');
    }

}