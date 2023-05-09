<?php

declare(strict_types=1);

namespace App;

use Nette\Configurator;
use Nette\Bootstrap\Configurator as NetteConfigurator;
use Nette\DI\ContainerLoader;

class Bootstrap
{
    public static function boot(): void
    {
        $configurator = new Configurator();
        $appDir = dirname(__DIR__);

        //$configurator->setDebugMode('secret@23.75.345.200'); // enable for your remote IP
        $configurator->enableTracy($appDir . '/log');

        $configurator->setTempDirectory($appDir . '/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addConfig($appDir . '/config/common.neon');
        $configurator->addConfig($appDir . '/config/services.neon');
        $configurator->addConfig($appDir . '/config/local.neon');

        $container = $configurator->createContainer();

        $router = Router\RouterFactory::createRouter();
        $container->addService('router', $router);

        $application = $container->getByType(Nette\Application\Application::class);
        $application->run();
    }
}

// Запуск додатку
Bootstrap::boot();