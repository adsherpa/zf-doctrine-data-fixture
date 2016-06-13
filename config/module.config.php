<?php

return array(
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
                        'route'    => 'doctrine:data-fixture:import [--group=]',
                        'defaults' => array(
                            'controller' => 'ZF\Doctrine\DataFixture\Controller\Import',
                            'action'     => 'create'
                        ),
                    ),
                ),
            ),
        ),
    ),
);