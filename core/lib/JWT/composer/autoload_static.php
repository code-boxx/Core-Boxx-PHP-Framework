<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4227a9262042b7b77c23e4da01de8cd1
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4227a9262042b7b77c23e4da01de8cd1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4227a9262042b7b77c23e4da01de8cd1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4227a9262042b7b77c23e4da01de8cd1::$classMap;

        }, null, ClassLoader::class);
    }
}
