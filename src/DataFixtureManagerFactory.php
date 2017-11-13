<?php

namespace ZF\Doctrine\DataFixture;

use RuntimeException;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;

class DataFixtureManagerFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $config = $container->get('Config');
        $request = $container->get('Request');

        if (isset($options['group'])) {
            $fixtureGroup = $options['group'];
        } else {
            $fixtureGroup = $request->params()->get(1);
        }

        if (! isset($config['doctrine']['fixture'][$fixtureGroup])) {
            throw new RuntimeException('Fixture group not found: ' . $fixtureGroup);
        }

        if (! isset($config['doctrine']['fixture'][$fixtureGroup]['object_manager'])) {
            throw new RuntimeException('Object manager not specified for fixture group ' . $fixtureGroup);
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
