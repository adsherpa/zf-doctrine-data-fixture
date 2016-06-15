<?php

namespace Db\Fixture;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TwoFixtureFactory implements
    FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new TwoFixture();
    }
}
