<?php

declare(strict_types=1);

namespace ZF\Doctrine\DataFixture\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\Doctrine\DataFixture\DataFixtureManager;
use ZF\Doctrine\DataFixture\DataFixtureManagerFactory;

class AbstractCommand extends Command
{

    const ARGUMENT_GROUP = 'group_name';

    /**
     * @var ServiceLocatorInterface
     */
    protected $container;

    /**
     * Command constructor
     *
     * @param ServiceLocatorInterface $container
     */
    public function __construct(ServiceLocatorInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    protected function getDataFixtureManager(InputInterface $input): DataFixtureManager
    {
        return $this->container->build(DataFixtureManager::class, [
            DataFixtureManagerFactory::OPTION_GROUP => $input->getArgument(self::ARGUMENT_GROUP),
        ]);
    }
}
