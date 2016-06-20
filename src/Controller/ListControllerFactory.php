<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ModuleManager\ServiceListener;

class ListControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dataFixtureManager = null;

        $serviceManager = $serviceLocator->getServiceLocator();

        $request = $serviceManager->get('Request');
        $config = $serviceManager->get('Config');
        $console = $serviceManager->get('Console');

        // If an object manager and group are specified include the data fixture manager
        if ($request->params()->get(1) && $request->params()->get(2)) {
            $dataFixtureManager = $serviceManager->get('ZF\Doctrine\DataFixture\DataFixtureManager');
        }

        $instance = new ListController($config['doctrine']['fixture'], $console, $dataFixtureManager);

        return $instance;
    }
}
