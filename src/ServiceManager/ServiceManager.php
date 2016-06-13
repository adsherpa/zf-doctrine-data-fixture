<?php

namespace ZF\Doctrine\DataFixture\ServiceManager;

use Zend\ServiceManager\ServiceManager as ZendServiceManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

class ServiceManager extends ZendServiceManager implements
    ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function getAll()
    {
        $fixtures = [];

        foreach ($this->canonicalNames as $name) {
            $fixtures = $this->get($name);
        }

        return $fixtures;
    }
}