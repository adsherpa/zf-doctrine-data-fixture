<?php

namespace ZF\Doctrine\DataFixture;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Exception;

class DataFixtureManagerFactory// implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = NULL
    ) {
        $config = $container->get('Config');
        $request = $container->get('Request');

        $fixtureGroup = $request->params()->get(1);

        if (! isset($config['doctrine']['fixture'][$fixtureGroup])) {
            throw new Exception('Fixture group not found: ' . $fixtureGroup);
        }

        if (! isset($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])) {
            throw new Exception('Object manager not specified for fixture group ' . $fixtureGroup);
        }

        $objectManager = $container->get($config['doctrine']['fixture'][$fixtureGroup]['object_manager']);

        $instance = new DataFixtureManager((array) $config['doctrine']['fixture'][$fixtureGroup]);
        $instance
            ->setServiceLocator($container)
            ->setObjectManagerAlias($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])
            ->setObjectManager($objectManager)
            ;

        return $instance;
    }
}
