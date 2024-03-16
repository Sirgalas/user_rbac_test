<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Http\Middleware\ErrorHandler;

use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;

class PrettyErrorResponseGeneratorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new PrettyErrorResponseGenerator(
            new Response(),
            [
                '403' => 'error/403',
                '404' => 'error/404',
                'error' => 'error/error',
            ]
        );
    }
}