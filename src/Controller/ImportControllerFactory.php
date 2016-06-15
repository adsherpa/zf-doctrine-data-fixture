<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ModuleManager\ServiceListener;

class ImportControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        $dataFixtureManager = $serviceManager->get('ZF\Doctrine\DataFixture\DataFixtureManager');
        $instance = new ImportController($dataFixtureManager);

        return $instance;
    }
}
