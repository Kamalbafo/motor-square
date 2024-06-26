<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit73376451eb1d4f9576ec710c5ff482c1
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit73376451eb1d4f9576ec710c5ff482c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit73376451eb1d4f9576ec710c5ff482c1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit73376451eb1d4f9576ec710c5ff482c1::$classMap;

        }, null, ClassLoader::class);
    }
}
