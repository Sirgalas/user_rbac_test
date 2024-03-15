<?php

declare(strict_types=1);

namespace UserRbacFramework\Route;

use Aura\Router\Exception\RouteNotFound;
use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;
use UserRbacFramework\Route\Exeption\RequestNotMatchedException;
use UserRbacFramework\Route\Exeption\RouteNotFoundException;

class AuraRouterAdapter implements Router
{
    private $aura;

    public function __construct(RouterContainer $aura)
    {
        $this->aura = $aura;
    }

    public function match(ServerRequestInterface $request): Result
    {
        $matcher = $this->aura->getMatcher();
        if ($route = $matcher->match($request)) {
            return new Result($route->name, $route->handler, $route->attributes);
        }

        throw new RequestNotMatchedException($request);
    }

    public function generate($name, array $params): string
    {
        $generator = $this->aura->getGenerator();
        try {
            return $generator->generate($name, $params);
        } catch (RouteNotFound $e) {
            throw new RouteNotFoundException($name, $params, $e);
        }
    }
}