<?php

namespace Db\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TwoFixture implements
    FixtureInterface
{
    public function load(ObjectManager $objectManager)
    {
        return true;
    }
}
