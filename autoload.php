<?php

class Autoloader
{
    private static $NAMESPACE = 'GithubSearch';

    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = sprintf('%s/%s.php',
                __DIR__,
                str_replace([self::$NAMESPACE, '\\'], ['src', DIRECTORY_SEPARATOR], $class)
            );

            if (file_exists($file)) {
                /** @noinspection PhpIncludeInspection */
                require_once $file;
                return true;
            }
            return false;
        });
    }
}

Autoloader::register();