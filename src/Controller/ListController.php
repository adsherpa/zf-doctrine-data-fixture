<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Mvc\Console\Controller\AbstractConsoleController;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;
use Zend\Console\ColorInterface as Color;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;
use ZF\Doctrine\DataFixture\DataFixtureManager;

class ListController extends AbstractConsoleController
{
    protected $config;
    protected $dataFixtureManager;

    public function __construct(array $config, ConsoleAdapter $console, DataFixtureManager $dataFixtureManager = null)
    {
        $this->config = $config;
        $this->setConsole($console);
        $this->dataFixtureManager = $dataFixtureManager;
    }

    public function listAction()
    {
        if ($this->dataFixtureManager) {
            $this->getConsole()->write('Group: ', Color::YELLOW);
            $this->getConsole()->write($this->params()->fromRoute('fixture-group') . "\n", Color::GREEN);
            $this->getConsole()->write('Object Manager: ', Color::YELLOW);
            $this->getConsole()->write($this->dataFixtureManager->getObjectManagerAlias() . "\n", Color::GREEN);

            foreach ($this->dataFixtureManager->getAll() as $fixture) {
                $this->getConsole()->write(get_class($fixture) . "\n", Color::CYAN);
            }
        } else {
            $this->getConsole()->write("All Fixture Groups\n", Color::RED);

            foreach ($this->config as $group => $smConfig) {
                $this->getConsole()->write("$group\n", Color::CYAN);
            }
        }
    }
}
