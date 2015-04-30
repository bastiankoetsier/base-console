<?php namespace Bkoetsier\BaseConsole;

use Composer\Script\Event;

class ComposerInit {

    protected static $vendorDir;
    protected static $baseDir;

    public static function postPackageInstall(Event $event)
    {
        self::setPaths($event);
        self::copyServiceProviderFile();
    }

    /**
     * copy service_providers.php to app-root
     * @return void
     */
    protected static function copyServiceProviderFile()
    {
        // copy service_provider to root dir
        $src = __DIR__ . '/../service_providers.php';
        $dst = self::$baseDir . DIRECTORY_SEPARATOR . 'service_providers.php';
        if( ! file_exists($dst)){
            var_dump(copy($src, $dst));
        }
    }

    /**
     * @param \Composer\Script\Event $event
     * @return void
     */
    protected static function setPaths(Event $event)
    {
        $composer = $event->getComposer();
        $config = $composer->getConfig();
        self::$vendorDir = realpath($config->get('vendor-dir'));
        self::$baseDir = realpath(self::$vendorDir . '../../../');
    }


}