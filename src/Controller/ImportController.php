<?php

namespace ZF\Doctrine\DataFixture\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use ZF\Doctrine\DataFixture\DataFixtureManager;
use Doctrine\Common\DataFixtures\Loader;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;

class ImportController extends AbstractActionController
{
    public function __construct(DataFixtureManager $dataFixtureManager)
    {
        $this->dataFixtureManager = $dataFixtureManager;
    }

    public function importAction()
    {
        if (! $this->getRequest() instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console.');
        }

        if ($this->params()->fromRoute('append')) {
            throw new RuntimeException('--append is now the default action');
        }

        $loader = new Loader();
        $purger = new ORMPurger();

        foreach ($this->dataFixtureManager->getAll() as $fixture) {
            $loader->addFixture($fixture);
        }

        if ($this->params()->fromRoute('purge-with-truncate')) {
            $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        }

        $executor = new ORMExecutor($this->dataFixtureManager->getObjectManager(), $purger);
        $executor->execute(
            $loader->getFixtures(),
            (bool) ! $this->params()->fromRoute('do-not-append')
        );
    }
}
