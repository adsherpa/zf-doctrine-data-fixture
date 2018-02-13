<?php

declare(strict_types=1);

$modules = [
    'Zend\Cache',
    'Zend\Form',
    'Zend\I18n',
];
if (class_exists('Zend\Filter\Module')) {
    $modules[] = 'Zend\Filter';
}
if (class_exists('Zend\Hydrator')) {
    $modules[] = 'Zend\Hydrator';
}
if (class_exists('Zend\InputFilter')) {
    $modules[] = 'Zend\InputFilter';
}

$modules = array_merge($modules, [
    'Zend\Paginator',
    'Zend\Router',
    'Zend\Validator',
    'Zend\Mvc\Console',
    'DoctrineModule',
    'DoctrineORMModule',
    'Db',
    'ZF\Doctrine\DataFixture',
]);

return [
    'modules'                 => $modules,
    'module_listener_options' => [
        'config_glob_paths' => [
            __DIR__ . '/local.php',
        ],
        'module_paths'      => [
            __DIR__ . '/../vendor',
            'Db'                      => __DIR__ . '/module/Db/src',
            'ZF\Doctrine\DataFixture' => __DIR__ . '/../..',
        ],
    ],
];
