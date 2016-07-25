<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use ZF\Doctrine\DataFixture\DataFixtureManager;
use Doctrine\Common\DataFixtures\Loader;
use Zend\Console\Adapter\Posix;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\ColorInterface as Color;
use RuntimeException;

class ListController extends AbstractActionController
{
    protected $config;
    protected $console;
    protected $dataFixtureManager;

    public function __construct(array $config, Posix $console, DataFixtureManager $dataFixtureManager = null)
    {
        $this->config = $config;
        $this->console = $console;
        $this->dataFixtureManager = $dataFixtureManager;
    }

    public function listAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }

        if ($this->dataFixtureManager) {
            $this->console->write('Object Manager: ', Color::YELLOW);
            $this->console->write($this->params()->fromRoute('object-manager') . "\n", Color::GREEN);
            $this->console->write('Group: ', Color::YELLOW);
            $this->console->write($this->params()->fromRoute('fixture-group') . "\n", Color::GREEN);

            foreach ($this->dataFixtureManager->getAll() as $fixture) {
                $this->console->write(get_class($fixture) . "\n", Color::CYAN);
            }
        } elseif ($this->params()->fromRoute('object-manager')) {
            $this->console->write("All Groups\n", Color::RED);
            $this->console->write('Object Manager: ', Color::YELLOW);
            $this->console->write($this->params()->fromRoute('object-manager') . "\n", Color::GREEN);

            foreach ($this->config[$this->params()->fromRoute('object-manager')] as $group => $smConfig) {
                $this->console->write("$group\n", Color::CYAN);
            }
        } else {
            $this->console->write("All Object Managers and Groups\n", Color::RED);

            foreach ($this->config as $objectManagerAlias => $groupConfig) {
                $this->console->write('Object Manager: ', Color::YELLOW);

                $this->console->write("$objectManagerAlias\n", Color::GREEN);

                foreach ($groupConfig as $group => $smConfig) {
                    $this->console->write("$group\n", Color::CYAN);
                }
            }
        }
    }
}
