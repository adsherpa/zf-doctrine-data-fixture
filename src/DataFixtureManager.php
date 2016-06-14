<?php

namespace ZF\Doctrine\DataFixture;

use Zend\ServiceManager\ServiceManager as ZendServiceManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

class DataFixtureManager extends ZendServiceManager implements
    ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function getAll()
    {
        $fixtures = [];

        foreach ($this->canonicalNames as $name => $squishedname) {
            $fixtures[] = $this->get($name);
        }

        return $fixtures;
    }
}