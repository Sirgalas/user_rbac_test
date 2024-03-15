<?php

declare(strict_types=1);

namespace UserRbacFramework;

class ActionResolver
{
    public function resolve($handler): callable
    {
        return \is_string($handler) ? new $handler() : $handler;
    }
}