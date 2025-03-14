<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita81d3e685c32395d8f3ac88cf4692075
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RedBeanPHP\\' => 11,
        ),
        'I' => 
        array (
            'InfoDec\\App\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RedBeanPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP',
        ),
        'InfoDec\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita81d3e685c32395d8f3ac88cf4692075::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita81d3e685c32395d8f3ac88cf4692075::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita81d3e685c32395d8f3ac88cf4692075::$classMap;

        }, null, ClassLoader::class);
    }
}
