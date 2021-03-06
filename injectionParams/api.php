<?php

use ASVoting\InjectionParams;

function injectionParams() : InjectionParams
{
    // These classes will only be created once by the injector.
    $shares = [
        \Auryn\Injector::class,
        \Doctrine\ORM\EntityManager::class
    ];

    // Alias interfaces (or classes) to the actual types that should be used
    // where they are required.
    $aliases = [
        \VarMap\VarMap::class => \VarMap\Psr7VarMap::class,

        \ASVoting\Repo\ProposedMotionRepo\ProposedMotionRepo::class =>
          \ASVoting\Repo\ProposedMotionRepo\FakeProposedMotionRepo::class,
    ];

    // Delegate the creation of types to callables.
    $delegates = [
        \Psr\Log\LoggerInterface::class => 'createLogger',
        \PDO::class => 'createPDO',
        \Doctrine\ORM\EntityManager::class => 'createDoctrineEntityManager',
        \Redis::class => 'createRedis',

        \ASVoting\MemoryWarningCheck\MemoryWarningCheck::class => 'createMemoryWarningCheck',
        \SlimAuryn\ExceptionMiddleware::class => 'createExceptionMiddlewareForApi',
        \SlimAuryn\SlimAurynInvokerFactory::class => 'createSlimAurynInvokerFactory',
        \Slim\App::class => 'createSlimAppForApi',
        \SlimAuryn\Routes::class => 'createRoutesForApi',
        \ASVoting\AppErrorHandler\AppErrorHandler::class =>
'createJsonAppErrorHandler',
    ];

    // Define some params that can be injected purely by name.
    $params = [];

    $prepares = [
    ];

    $defines = [];

    $injectionParams = new InjectionParams(
        $shares,
        $aliases,
        $delegates,
        $params,
        $prepares,
        $defines
    );

    return $injectionParams;
}
