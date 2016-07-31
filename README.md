ZF Doctrine Data Fixture
========================

[![Build status](https://api.travis-ci.org/API-Skeletons/zf-doctrine-data-fixture.svg)](http://travis-ci.org/API-Skeletons/zf-doctrine-data-fixture)
[![Total Downloads](https://poser.pugx.org/API-Skeletons/zf-doctrine-data-fixture/downloads)](https://packagist.org/packages/API-Skeletons/zf-doctrine-data-fixture)


This provides command line support for Doctrine Fixtures in Zend Framework 2.
Often projects will have multiple sets of fixtures for different object managers or modules such as
from a 3rd party API.  When this is the case a tool which can run fixtures in groups is needed.
Additionally dependency injection must be available to the fixtures.  To accomplish these needs
this module uses a Zend Service Manager configurable on a per-Object Manager, per-group basis.

[![Watch and learn from the maintainer of this repository](https://raw.githubusercontent.com/API-Skeletons/zf-doctrine-data-fixture/master/media/api-skeletons-play.png)](https://apiskeletons.pivotshare.com/media/zf-doctrine-data-fixture/50624)


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


Listing Fixtures
----------------

```sh
index.php data-fixture:list [<object-manager>] [<group>]
```

List all object managers and their groups, list all groups for a given object manager, or specify object manager and group to list all fixtures for a group.


Executing Fixtures
------------------

```sh
index.php data-fixture:import <object-manager> <group> [--purge-with-truncate] [--append]
```

The `<object-manager>` and `<group>` are required.  The `<object-manager>` is the suffix of the doctrine string identifying the object manager.  This is always `doctrine.entitymanager.<object_manager>` so the default object manager is `orm_default`.  The group is configured per `<object_manager>` and different object managers may have the same group name such as `default`.

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

* You can only run one entity manager group at a time.  If you need to run more create a script to run them in sequence.
* The ServiceManager is injected into each DataFixtureManager at getServiceLocator() so you can use instantiators which run from that level.  This makes the DataFixtureManager work like a plugin manager defined with `$serviceListener->addServiceManager()`.
* You cannot use abstract factories.  Each fixture must be individually configured.
* You can use initializers.  I suggest you do.
* Do not use constructor (dependency) injection.  The Doctrine fixture `Loader` creates fixtures even if they are already loaded in the fixture manager so any fixtures created via factory cannot use constructor injection.

History
-------

This module is a near complete rewrite of [hounddog/doctrine-data-fixture-module](https://github.com/Hounddog/DoctrineDataFixtureModule).  All the patterns have changed and the code was reduced.  That module served me and the community well for a long time.
