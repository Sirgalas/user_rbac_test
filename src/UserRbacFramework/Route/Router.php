<?php

declare(strict_types=1);

namespace UserRbacFramework\Route;


use Psr\Http\Message\ServerRequestInterface;
use UserRbacFramework\Route\Exeption\RequestNotMatchedException;
use UserRbacFramework\Route\Exeption\RouteNotFoundException;

interface Router
{
    /**
     * @param ServerRequestInterface $request
     * @throws RequestNotMatchedException
     * @return Result
     */
    public function match(ServerRequestInterface $request): Result;

    /**
     * @param string $name
     * @param array $params
     * @throws RouteNotFoundException
     * @return string
     */
    public function generate(string $name, array $params): string;
}