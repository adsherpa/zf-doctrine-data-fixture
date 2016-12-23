<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;

class ListControllerFactory // implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = NULL
    ) {
        $dataFixtureManager = null;

        $serviceManager = $container->getServiceLocator() ?: $container;

        $request = $serviceManager->get('Request');
        $config = $serviceManager->get('Config');
        $console = $serviceManager->get('Console');

        // If an object manager and group are specified include the data fixture manager
        if ($request->params()->get(1)) {
            $dataFixtureManager = $serviceManager->get('ZF\Doctrine\DataFixture\DataFixtureManager');
        }

        $instance = new ListController((array) $config['doctrine']['fixture'], $console, $dataFixtureManager);

        return $instance;
    }
}
