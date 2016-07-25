<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ModuleManager\ServiceListener;

class HelpControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new HelpController($serviceLocator->getServiceLocator()->get('Console'));
    }
}
