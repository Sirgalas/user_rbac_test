<?php

declare(strict_types=1);

namespace UserRbacFramework\Route;

class Result
{
    public function __construct(readonly string $name, readonly mixed $handler, readonly array $attributes){}


    public function getName(): string
    {
        return $this->name;
    }

    public function getHandler(): mixed
    {
        return $this->handler;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }


}