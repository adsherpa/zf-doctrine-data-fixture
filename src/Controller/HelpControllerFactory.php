<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ModuleManager\ServiceListener;
use Interop\Container\ContainerInterface;

class HelpControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new HelpController($serviceLocator->getServiceLocator()->get('Console'));
    }

    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = NULL
    ) {
        return $this->createService($container);
    }
}
