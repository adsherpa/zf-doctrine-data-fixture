ZF Doctrine Data Fixture
========================

[![Build status](https://api.travis-ci.org/zfcampus/zf-doctrine-data-fixture.svg)](http://travis-ci.org/zfcampus/zf-doctrine-data-fixture)
[![Total Downloads](https://poser.pugx.org/api-skeletons/zf-doctrine-data-fixture/downloads)](https://packagist.org/packages/api-skeletons/zf-doctrine-data-fixture)


This provides command line support for Doctrine Fixtures in Zend Framework 2.
Often projects will have multiple sets of fixtures for different databases or modules such as
from a 3rd party API.  When this is the case a tool which can run fixtures in groups is needed.
Additionally dependency injection must be available to the fixtures.  To accomplish these needs
this module uses a Zend Service Manager configurable on a per-Object Manager, per-group basis.


Installation
------------

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
$ composer require api-skeletons/zf-doctrine-data-fixture ^1.0
```

Add this module to your application's configuration:

```php
'modules' => [
   ...
   'ZF\\Doctrine\DataFixture',
],
```


Configuration
--------------

This module builds on top of Doctrine configuration.  The configuration in a module which implements fixtures is:

```php
return [
    'doctrine' => [
        'fixture' => [
            'orm_default' => [
                'group1' => [
                    'invokables' => [
                        'ModuleName\Fixture\FixtureOne' => 'ModuleName\Fixture\FixtureOne',
                    ],
                    'factories' => [
                        'ModuleName\Fixture\FixtureTwo' => 'ModuleName\Fixture\FixtureTwoFactory',
                    ]
                ],
                'group2' => [
                    ...
                ],
            ],
            'orm_zf_doctrine_audit' => [
                'group1' => [
                    ...
                ],
                'group3' => [
                    ...
                ]
            ],
        ],
    ],
];
```

Each group is a [Zend ServiceManager](http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html) configuration.  This allows complete dependency injection control of your fixtures.


Executing Fixtures
------------------

```sh
index.php data-fixture:import <object-manager> <group> [--purge-with-truncate] [--append]
```

The `<object-manager>` and `<group>` are required.  The `<object-manager>` is the suffix of the doctrine string identifying the object manager.  This is always `doctrine.entitymanager.<object_manager>` so the default object manager is `orm_default`.  The group is configured per `<object_manager>` and different object managers may have the same group name such as `default`.

`--purge-with-truncate` if specified will purge the object manager's tables before running fixtures.

`--append` will append values to the tables.  The author does not believe this option should be used.  When writing fixtures you should validate whether each entity already exists and update it explicitly, or add it if it does not exist.
