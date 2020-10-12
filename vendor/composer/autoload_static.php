<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9736fc4cb7f519c412ad2b869ce5814c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Posticon\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Posticon\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Posticon\\Actions\\OnActivation' => __DIR__ . '/../..' . '/src/Actions/OnActivation.php',
        'Posticon\\Actions\\OnOptionSubmit' => __DIR__ . '/../..' . '/src/Actions/OnOptionSubmit.php',
        'Posticon\\Actions\\OnUninstall' => __DIR__ . '/../..' . '/src/Actions/OnUninstall.php',
        'Posticon\\Admin\\RegisterAdminPage' => __DIR__ . '/../..' . '/src/Admin/RegisterAdminPage.php',
        'Posticon\\Admin\\RegisterSettings' => __DIR__ . '/../..' . '/src/Admin/RegisterSettings.php',
        'Posticon\\Admin\\SettingsPage' => __DIR__ . '/../..' . '/src/Admin/Template/SettingsPage.php',
        'Posticon\\Database\\CreateTable' => __DIR__ . '/../..' . '/src/Database/CreateTable.php',
        'Posticon\\Database\\DatabaseSettings' => __DIR__ . '/../..' . '/src/Database/DatabaseSettings.php',
        'Posticon\\Database\\DeleteTable' => __DIR__ . '/../..' . '/src/Database/DeleteTable.php',
        'Posticon\\Database\\ReadDatabase' => __DIR__ . '/../..' . '/src/Database/ReadDatabase.php',
        'Posticon\\Database\\WriteDatabase' => __DIR__ . '/../..' . '/src/Database/WriteDatabase.php',
        'Posticon\\Init' => __DIR__ . '/../..' . '/src/Init.php',
        'Posticon\\Setup\\EnqueueScripts' => __DIR__ . '/../..' . '/src/Setup/EnqueueScripts.php',
        'Posticon\\Views\\ShowIcon' => __DIR__ . '/../..' . '/src/Views/ShowIcon.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9736fc4cb7f519c412ad2b869ce5814c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9736fc4cb7f519c412ad2b869ce5814c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9736fc4cb7f519c412ad2b869ce5814c::$classMap;

        }, null, ClassLoader::class);
    }
}
