<?php

 namespace ZF\Doctrine\DataFixture\Factory;

 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;
 use Zend\ModuleManager\ServiceListener;

class ImportControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request = $serviceManager->get('Request');
        $serviceManager = $serviceLocator->getServiceLocator();

        $dataFixtureManager = $serviceManager->get('ZF\Doctrine\DataFixture\DataFixtureManager');
        $objectManagerKey = $request->getParam('objectManager', 'orm_default');

        $instance = new ImportController();
        $instance->setDataFixtureManager($dataFixtureManager);
        $instance->setObjectManager($serviceManager->get('doctrine.entitymanager.' . $objectManagerKey));

        return $instance;
    }
}