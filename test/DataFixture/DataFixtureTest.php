<?php

declare(strict_types=1);

namespace ZFTest\Doctrine\DataFixture;

use DateTime;
use Db\Entity;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\Tools\SchemaTool;
use Psr\Container\ContainerExceptionInterface;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use ZF\Doctrine\DataFixture\DataFixtureManager;
use ZF\Doctrine\DataFixture\Loader;

class DataFixtureTest extends AbstractConsoleControllerTestCase
{

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/application.config.php'
        );
        parent::setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $objectManager  = $serviceManager->get(
            'doctrine.entitymanager.orm_default'
        );

        $tool = new SchemaTool($objectManager);
        $tool->createSchema(
            $objectManager->getMetadataFactory()->getAllMetadata()
        );

        $artist1 = new Entity\Artist;
        $artist1->setName('ABBA');
        $artist1->setCreatedAt(new DateTime('2011-12-18 13:17:17'));
        $objectManager->persist($artist1);

        $objectManager->flush();
    }

    /**
     * @throws \Exception
     */
    public function testField()
    {
        $this->dispatch('data-fixture:import test-standard');
    }

    /**
     * @throws ContainerExceptionInterface
     */
    public function testBuildStandardDataFixtureManager()
    {
        $dataFixtureManager = $this->getApplication()->getServiceManager()
                                ->build(
                                    DataFixtureManager::class,
                                    ['group' => 'test-standard']
                                );

        $loader = new Loader($dataFixtureManager);
        $purger = new ORMPurger;

        foreach ($dataFixtureManager->getAll() as $fixture) {
            $loader->addFixture($fixture);
        }

        $executor = new ORMExecutor(
            $dataFixtureManager->getObjectManager(),
            $purger
        );
        $executor->execute($loader->getFixtures(), true);

        $this->assertTrue(true);
    }

    /**
     * @throws ContainerExceptionInterface
     */
    public function testBuildDependentDataFixtureManager()
    {
        $dataFixtureManager = $this->getApplication()->getServiceManager()
                                ->build(
                                    DataFixtureManager::class,
                                    ['group' => 'test-dependency']
                                );

        $loader = new Loader($dataFixtureManager);
        $purger = new ORMPurger;

        foreach ($dataFixtureManager->getAll() as $fixture) {
            $loader->addFixture($fixture);
        }

        $executor = new ORMExecutor(
            $dataFixtureManager->getObjectManager(),
            $purger
        );
        $executor->execute($loader->getFixtures(), true);

        $this->assertTrue(true);
    }
}
