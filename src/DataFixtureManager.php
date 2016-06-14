<?php

namespace ZF\Doctrine\DataFixture;

use Zend\ServiceManager\ServiceManager as ZendServiceManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

class DataFixtureManager extends ZendServiceManager implements
    ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    protected $serviceLocator;

    public function getAll()
    {
        $fixtures = [];

        foreach ($this->canonicalNames as $name => $squishedname) {
            $fixtures[] = $this->get($name);
        }

        return $fixtures;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}