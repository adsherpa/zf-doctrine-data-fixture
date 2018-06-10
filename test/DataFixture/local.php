<?php

declare(strict_types=1);

use Db\Fixture\DependencyFixture;
use Db\Fixture\DependencyFixtureFactory;
use Db\Fixture\DependentFixture;
use Db\Fixture\DependentFixtureFactory;
use Db\Fixture\FactoryFixture;
use Db\Fixture\FactoryFixtureFactory;
use Db\Fixture\StandardFixture;
use Doctrine\DBAL\Driver\PDOSqlite\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'configuration' => 'orm_default',
                'eventmanager'  => 'orm_default',
                'driverClass'   => Driver::class,
                'params'        => [
                    'memory' => true,
                ],
            ],
        ],
        'fixture'    => [
            'test-standard'   => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'invokables'     => [
                    StandardFixture::class,
                ],
                'factories'      => [
                    FactoryFixture::class => FactoryFixtureFactory::class,
                ],
            ],
            'test-dependency' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'factories'      => [
                    /**
                     * Load the dependent fixture first to test whether the
                     * constructor is called of the dependency
                     */
                    DependentFixture::class  => DependentFixtureFactory::class,
                    DependencyFixture::class => DependencyFixtureFactory::class,
                ],
            ],
        ],
    ],
];
