<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2cd6296cebeec9716d152e843de6992a
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit2cd6296cebeec9716d152e843de6992a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2cd6296cebeec9716d152e843de6992a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2cd6296cebeec9716d152e843de6992a::$classMap;

        }, null, ClassLoader::class);
    }
}