<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager'  => 'orm_default',
                'driverClass'   => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                'params' => array(
                    'memory' => true,
                ),
            ),
        ),
        'fixture' => array(
            'test' => array(
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'invokables' => array(
                    'Db\Fixture\OneFixture' =>
                        'Db\Fixture\OneFixture',
                ),
                'factories' => array(
                    'Db\Fixture\TwoFixture' =>
                        'Db\Fixture\TwoFixtureFactory',
                ),
            ),
            'test2' => array(
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'invokables' => array(
                    'Db\Fixture\OneFixture' =>
                        'Db\Fixture\OneFixture',
                ),
                'factories' => array(
                    'Db\Fixture\TwoFixture' =>
                        'Db\Fixture\TwoFixtureFactory',
                ),
            ),
        ),
    ),
);
