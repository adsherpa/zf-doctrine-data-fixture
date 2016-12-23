<?php

namespace ZF\Doctrine\DataFixture;

use Zend\ServiceManager\ServiceManager as ZendServiceManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use Interop\Container\ContainerInterface;

class DataFixtureManager extends ZendServiceManager implements
    ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    protected $serviceLocator;
    protected $objectManagerAlias;

    public function getAll()
    {
        $fixtures = [];

        foreach ((array) $this->factories as $name => $squishedname) {
            $fixtures[] = $this->get($name);
        }

        return $fixtures;
    }

    public function setObjectManagerAlias($alias)
    {
        $this->objectManagerAlias = $alias;

        return $this;
    }

    public function getObjectManagerAlias()
    {
        return $this->objectManagerAlias;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ContainerInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }
}
