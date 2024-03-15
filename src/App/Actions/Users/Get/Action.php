<?php

declare(strict_types=1);

namespace App\Actions\Users\Get;

use Laminas\Diactoros\Response\JsonResponse;

class Action
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            ['id' => 2, 'name' => 'John Doe','group' => ['admins'], 'roles' => ['send_messages']],
        ]);
    }
}