<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;

class ImportControllerFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $dataFixtureManager = $container->get('ZF\Doctrine\DataFixture\DataFixtureManager');
        $instance = new ImportController($dataFixtureManager);

        return $instance;
    }
}
