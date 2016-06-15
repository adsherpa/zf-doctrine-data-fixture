<?php

return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'Db',
        'ZF\Doctrine\DataFixture',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            __DIR__ . '/local.php',
        ),
        'module_paths' => array(
            __DIR__ . '/../vendor',
            'Db' => __DIR__ . '/module/Db',
            'ZF\Doctrine\DataFixture' => __DIR__ . '/../..',
        ),
    ),
);
