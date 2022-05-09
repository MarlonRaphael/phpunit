<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2a33e2ed3cefd1468f3f8ac3804b6899
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit2a33e2ed3cefd1468f3f8ac3804b6899', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2a33e2ed3cefd1468f3f8ac3804b6899', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2a33e2ed3cefd1468f3f8ac3804b6899::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit2a33e2ed3cefd1468f3f8ac3804b6899::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire2a33e2ed3cefd1468f3f8ac3804b6899($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire2a33e2ed3cefd1468f3f8ac3804b6899($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}