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

        $objectManagerKey = $request->params()->get(1);
        $fixtureGroup = $request->params()->get(2);

        if (! isset($config['doctrine']['fixture'][$objectManagerKey][$fixtureGroup])) {
            throw new Exception('Fixture group not found: ' . $objectManagerKey . ' ' . $fixtureGroup);
        }

        $dataFixtureConfig = new Config($config['doctrine']['fixture'][$objectManagerKey][$fixtureGroup]);

        $dataFixtureServiceManager = new DataFixtureManager($dataFixtureConfig);
        $dataFixtureServiceManager->setObjectManager(
            $serviceLocator->get('doctrine.entitymanager.' . $objectManagerKey)
        );

        return $dataFixtureServiceManager;
    }
}