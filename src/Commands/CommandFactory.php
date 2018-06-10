<?php

declare(strict_types=1);

namespace ZF\Doctrine\DataFixture\Commands;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CommandFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): AbstractCommand {
        return new $requestedName($container);
    }
}
