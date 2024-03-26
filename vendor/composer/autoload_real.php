<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit838d19fa4f9e8f57f086488b2e4fc97e
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

        spl_autoload_register(array('ComposerAutoloaderInit838d19fa4f9e8f57f086488b2e4fc97e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit838d19fa4f9e8f57f086488b2e4fc97e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit838d19fa4f9e8f57f086488b2e4fc97e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}