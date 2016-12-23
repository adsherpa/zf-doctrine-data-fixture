<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;
use Zend\Console\Adapter\Posix;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\ColorInterface as Color;
use RuntimeException;

class HelpController extends AbstractActionController
{
    protected $config;
    protected $console;

    public function __construct(Posix $console)
    {
        $this->console = $console;
    }

    public function helpAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }
        $help = <<<EOF
Usage:
    data-fixture:import group_name

Options:
    --purge-with-truncate
        If specified will purge the object manager's tables using truncate
        before running fixtures.

    --append
        Will append values to the tables.  If you are re-running fixtures be
        sure to use this.  If you do not specify this option the object
        manager's tables will be emptied!

EOF;

        $this->console->write($help);
    }
}
