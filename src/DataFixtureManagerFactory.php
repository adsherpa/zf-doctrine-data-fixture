<?php

namespace ZF\Doctrine\DataFixture;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;
use Exception;

class DataFixtureManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $request = $serviceLocator->get('Request');

        $fixtureGroup = $request->params()->get(1);

        if (! isset($config['doctrine']['fixture'][$fixtureGroup])) {
            throw new Exception('Fixture group not found: ' . $fixtureGroup);
        }

        if (! isset($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])) {
            throw new Exception('Object manager not specified for fixture group ' . $fixtureGroup);
        }

        $dataFixtureConfig = new Config($config['doctrine']['fixture'][$fixtureGroup]);
        $objectManager = $serviceLocator->get($config['doctrine']['fixture'][$fixtureGroup]['object_manager']);

        $instance = new DataFixtureManager($dataFixtureConfig);
        $instance
            ->setServiceLocator($serviceLocator)
            ->setObjectManagerAlias($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])
            ->setObjectManager($objectManager)
            ;

        return $instance;
    }
}
