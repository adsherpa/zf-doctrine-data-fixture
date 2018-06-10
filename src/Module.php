<?php

declare(strict_types=1);

namespace ZF\Doctrine\DataFixture;

use Symfony\Component\Console\Application;
use Zend\EventManager\EventInterface;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\ServiceManager\ServiceManager;
use ZF\Doctrine\DataFixture\Commands\ImportCommand;
use ZF\Doctrine\DataFixture\Commands\ListCommand;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    InitProviderInterface
{

    /**
     * @inheritdoc
     */
    public function getConfig(): array
    {
        return ['service_manager' => (new ConfigProvider)->getDependencies(),];
    }

    /**
     * @inheritdoc
     */
    public function getAutoloaderConfig(): array
    {
        return [
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init(ModuleManagerInterface $manager): void
    {
        $eventManager = $manager->getEventManager();
        if (! $eventManager) {
            throw new \RuntimeException('Unable to retrieve event manager.');
        }

        $sharedEventManager = $eventManager->getSharedManager();
        if (! $sharedEventManager) {
            throw new \RuntimeException('Unable to retrieve shared event manager.');
        }

        $sharedEventManager->attach(
            'doctrine',
            'loadCli.post',
            function (EventInterface $event) {
                $application = $event->getTarget();
                if (! $application instanceof Application) {
                    throw new \RuntimeException('Unable to retrieve application.');
                }

                $container = $event->getParam('ServiceManager');
                if (! $container instanceof ServiceManager) {
                    throw new \RuntimeException('Unable to retrieve service manager.');
                }

                $application->addCommands([
                    $container->get(ImportCommand::class),
                    $container->get(ListCommand::class),
                ]);
            }
        );
    }
}
