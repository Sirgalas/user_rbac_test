<?php

declare(strict_types=1);

namespace App\Actions\Users\Delete;

use Laminas\Diactoros\Response\JsonResponse;

class Action
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['success' => 'ok']);
    }
}