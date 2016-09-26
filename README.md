ZF Doctrine Data Fixture
========================

[![Build status](https://api.travis-ci.org/API-Skeletons/zf-doctrine-data-fixture.svg)](http://travis-ci.org/API-Skeletons/zf-doctrine-data-fixture)
[![Total Downloads](https://poser.pugx.org/API-Skeletons/zf-doctrine-data-fixture/downloads)](https://packagist.org/packages/API-Skeletons/zf-doctrine-data-fixture)


This provides command line support for Doctrine Fixtures in Zend Framework 2.
Often projects will have multiple sets of fixtures for different object managers or modules such as
from a 3rd party API.  When this is the case a tool which can run fixtures in groups is needed.
Additionally dependency injection must be available to the fixtures.  To accomplish these needs
this module uses a Zend Service Manager configurable on a per-group basis.


Installation
------------

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
$ composer require api-skeletons/zf-doctrine-data-fixture ^2.0
```

Add this module to your application's configuration:

```php
'modules' => [
   ...
   'ZF\Doctrine\DataFixture',
],
```


Configuration
--------------

This module builds on top of Doctrine configuration.  The configuration in a module which implements fixtures is:

```php
return [
    'doctrine' => [
        'fixture' => [
            'group1' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'invokables' => [
                    'ModuleName\Fixture\FixtureOne' => 'ModuleName\Fixture\FixtureOne',
                ],
                'factories' => [
                    'ModuleName\Fixture\FixtureTwo' => 'ModuleName\Fixture\FixtureTwoFactory',
                ]
            ],
            'group2' => [
                'object_manager' => 'doctrine.entitymanager.orm_zf_doctrine_audit',
                ...
            ],
        ],
    ],
];
```

Each group is a [Zend ServiceManager](http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html) configuration.  This allows complete dependency injection control of your fixtures.


Listing Fixtures
----------------

```sh
index.php data-fixture:list [<group>]
```

List all object managers and their groups, list all groups for a given object manager, or specify object manager and group to list all fixtures for a group.


Executing Fixtures
------------------

```sh
index.php data-fixture:import <group> [--purge-with-truncate] [--append]
```

The `<group>` is required.

Options:

`--purge-with-truncate` if specified will purge the object manager's tables before running fixtures.

`--append` will append values to the tables.  If you are re-running fixtures be sure to use this.

*Note the default behavior is to delete all data* managed by the object manager.  If you're running fixtures on an existing database be sure to use `--append`.


Getting Help
------------

```sh
index.php data-fixture:help
```


Important Notes
---------------

* You can only run one group at a time.  If you need to run more create a script to run them in sequence.
* The ServiceManager is injected into each DataFixtureManager at getServiceLocator() so you can use instantiators which run from that level.  This makes the DataFixtureManager work like a plugin manager defined with `$serviceListener->addServiceManager()`.
* You cannot use abstract factories.  Each fixture must be individually configured.
* You can use initializers.  I suggest you do.
* Do not use constructor (dependency) injection.  The Doctrine fixture `Loader` creates fixtures even if they are already loaded in the fixture manager so any fixtures created via factory cannot use constructor injection.  The author also feels this is a poor practice.

History
-------

Version 1.0 of this module grouped groups by partial object manager alias.  This limited grouping of 3rd party fixtures and the flexibility of using ODM.

This module is a near complete rewrite of [hounddog/doctrine-data-fixture-module](https://github.com/Hounddog/DoctrineDataFixtureModule).  All the patterns have changed and the code was reduced.  That module served me and the community well for a long time.
