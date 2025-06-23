<?php

declare(strict_types=1);

use Codefog\PollsBundle\BackendController\ResetPollController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->defaults()
        ->autoconfigure()
        ->autowire()
    ;

    $services
        ->load('Codefog\\PollsBundle\\', __DIR__ . '/../src')
        ->exclude(__DIR__ . '/../src/ContaoManager')
        ->exclude(__DIR__ . '/../src/DependencyInjection')
        ->exclude(__DIR__ . '/../src/Model')
        ->exclude(__DIR__ . '/../src/Poll.php')
    ;

    $services
        ->set(ResetPollController::class)
        ->public()
    ;
};
