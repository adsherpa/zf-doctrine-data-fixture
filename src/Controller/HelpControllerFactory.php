<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Interop\Container\ContainerInterface;

class HelpControllerFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = NULL
    ) {
        return new HelpController($container->get('Console'));
    }
}
