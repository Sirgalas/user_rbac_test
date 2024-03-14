<?php

declare(strict_types=1);

namespace App\UserRbacFramework\Http;

class Request
{
    public function getQueryParams(): array
    {
        return $_GET;
    }

    public function getParsedBody()
    {
        return $_POST ?: null;
    }
}