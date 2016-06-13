ZF Doctrine Data Fixture
========================

This provides command line support for Doctrine fixtures to Zend Framework 2.
Often projects will have multiple sets of fixtures for different databases or modules such as
from a 3rd party API.  When this is the case a tool which can run fixtures in groups is needed.
Additionally dependency injection must be available to the fixtures.  To accomplish these needs
this modules uses a Zend ServiceManager configurable on a per-group per-object manager basis.


Installation
------------

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
$ composer require api-skeletons/zf-doctrine-data-fixture dev-master
```


Configuration
--------------

This module builds on top of Doctrine configuration.  The configuration in a module which implements
fixtures is as such:

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
                'group3' => [
                    ...
                ],
            ],
        ],
    ],
];
```

Each group is a [Zend ServiceManager](http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html)
configuration.  This allows complete dependency injection control of your fixtures.


#### Command Line
Access the Doctrine command line as following

##Import
```sh
index.php vendor/bin/doctrine-module data-fixture:import <object_manager> <group>
```
