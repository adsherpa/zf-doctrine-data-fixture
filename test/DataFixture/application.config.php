<?php

return array(
    'modules' => array(
        'Zend\\Cache',
        'Zend\\Form',
        'Zend\\I18n',
        'Zend\\Filter',
        'Zend\\Hydrator',
        'Zend\\InputFilter',
        'Zend\\Paginator',
        'Zend\\Router',
        'Zend\\Validator',
        'Zend\Mvc\Console',
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
