<?php

declare(strict_types=1);

namespace UserRbacFramework\Route\Exeption;

class RouteNotFoundException extends \LogicException
{
    public function __construct(string $name, readonly array $params)
    {
        parent::__construct(sprintf('Route %s not found',$name));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}