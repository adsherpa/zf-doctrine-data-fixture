<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'ZF\Doctrine\DataFixture\DataFixtureManager' =>
                'ZF\Doctrine\DataFixture\DataFixtureManagerFactory'
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'ZF\Doctrine\DataFixture\Controller\Import' =>
                'ZF\Doctrine\DataFixture\Controller\ImportControllerFactory',
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'zf-doctrine-data-fixture-import' => array(
                    'options' => array(
                        'route'    => 'data-fixture:import <object-manager> <fixture-group> [--append] [--purge-with-truncate]',
                        'defaults' => array(
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\Import',
                            'action'     => 'import'
                        ),
                    ),
                ),
            ),
        ),
    ),
);