<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite616fbc6ac4456979b1e2592130ae264
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Cache\\' => 10,
        ),
        'D' => 
        array (
            'Detection\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'Detection\\' => 
        array (
            0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite616fbc6ac4456979b1e2592130ae264::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite616fbc6ac4456979b1e2592130ae264::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite616fbc6ac4456979b1e2592130ae264::$classMap;

        }, null, ClassLoader::class);
    }
}
