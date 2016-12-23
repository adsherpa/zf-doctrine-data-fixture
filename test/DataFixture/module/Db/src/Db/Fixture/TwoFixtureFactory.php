<?php

namespace Db\Fixture;

use Interop\Container\ContainerInterface;

class TwoFixtureFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        return new TwoFixture();
    }
}
