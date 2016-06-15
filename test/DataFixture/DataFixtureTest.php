<?php

namespace ZFTest\Doctrine\DataFixture;

use Doctrine\ORM\Tools\SchemaTool;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
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
        $this->dispatch('data-fixture:import orm_default test');
    }
}
