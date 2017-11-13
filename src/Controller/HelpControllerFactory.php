<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;

class HelpControllerFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $instance = new HelpController()
        $instance->setConsole($container->get('Console'));

        return $instance;
    }
}
