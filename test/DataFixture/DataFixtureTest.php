<?php

namespace ZFTest\Doctrine\DataFixture;

use Doctrine\ORM\Tools\SchemaTool;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;
use DateTime;
use Db\Entity;

class DataFixtureTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/application.config.php'
        );
        parent::setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $objectManager = $serviceManager->get('doctrine.entitymanager.orm_default');

        $tool = new SchemaTool($objectManager);
        $res = $tool->createSchema($objectManager->getMetadataFactory()->getAllMetadata());

        $artist1 = new Entity\Artist;
        $artist1->setName('ABBA');
        $artist1->setCreatedAt(new DateTime('2011-12-18 13:17:17'));
        $objectManager->persist($artist1);

        $objectManager->flush();
    }

    public function testField()
    {
        $this->dispatch('data-fixture:import test');
    }

    public function testBuildDataFixtureManager()
    {
        $serviceManager = $this->getApplication()->getServiceManager();
        $objectManager = $serviceManager->get('doctrine.entitymanager.orm_default');
        $dataFixtureManager = $this->getApplication()->getServiceManager()
            ->build('ZF\Doctrine\DataFixture\DataFixtureManager', ['group' => 'test2']);
        
        $loader = new Loader();
        $purger = new ORMPurger();

        foreach ($dataFixtureManager->getAll() as $fixture) {
            $loader->addFixture($fixture);
        }

        $executor = new ORMExecutor($dataFixtureManager->getObjectManager(), $purger);
        $executor->execute($loader->getFixtures(), true);

        $this->assertTrue(true);
    }
}
