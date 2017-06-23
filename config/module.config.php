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
            'ZF\Doctrine\DataFixture\Controller\Help' =>
                'ZF\Doctrine\DataFixture\Controller\HelpControllerFactory',
            'ZF\Doctrine\DataFixture\Controller\Import' =>
                'ZF\Doctrine\DataFixture\Controller\ImportControllerFactory',
            'ZF\Doctrine\DataFixture\Controller\List' =>
                'ZF\Doctrine\DataFixture\Controller\ListControllerFactory',
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'zf-doctrine-data-fixture-help' => array(
                    'options' => array(
                        'route'    => 'data-fixture:help',
                        'defaults' => array(
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\Help',
                            'action'     => 'help'
                        ),
                    ),
                ),

                'zf-doctrine-data-fixture-import' => array(
                    'options' => array(
                        'route'    => 'data-fixture:import <fixture-group> [--append] [--do-not-append] [--purge-with-truncate]',
                        'defaults' => array(
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\Import',
                            'action'     => 'import'
                        ),
                    ),
                ),

                'zf-doctrine-data-fixture-list' => array(
                    'options' => array(
                        'route'    => 'data-fixture:list [<fixture-group>]',
                        'defaults' => array(
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\List',
                            'action'     => 'list'
                        ),
                    ),
                ),
            ),
        ),
    ),
);
