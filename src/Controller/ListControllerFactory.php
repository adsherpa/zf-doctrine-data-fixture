<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;

class ListControllerFactory // implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $dataFixtureManager = null;

        $request = $container->get('Request');
        $config = $container->get('Config');
        $console = $container->get('Console');

        // If an object manager and group are specified include the data fixture manager
        if ($request->params()->get(1)) {
            $dataFixtureManager = $container->get('ZF\Doctrine\DataFixture\DataFixtureManager');
        }

        $instance = new ListController((array) $config['doctrine']['fixture'], $console, $dataFixtureManager);

        return $instance;
    }
}
