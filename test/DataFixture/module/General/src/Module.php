<?php

declare(strict_types=1);

namespace General;

use General\Listener\EventCatcher;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface, BootstrapListenerInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function onBootstrap(EventInterface $event)
    {
        $application        = $event->getApplication();
        $serviceManager     = $application->getServiceManager();
        $eventManager       = $application->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();

        $eventCatcher = $serviceManager->get(EventCatcher::class);
        $sharedEventManager->attachAggregate($eventCatcher);
    }
}
