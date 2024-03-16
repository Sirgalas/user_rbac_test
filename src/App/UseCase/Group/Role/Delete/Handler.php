<?php

declare(strict_types=1);

namespace App\UseCase\Group\Role\Delete;

use App\UseCase\Group\AbstractGroupHandler;
use App\UseCase\User\AbstractUserHandler;

class Handler extends AbstractGroupHandler
{
    public function handle(RequestData $data): ResponseData
    {
        $this->groupDao->delete($data->role_id, $data->group_id);
        return new ResponseData(['message' => ['status' => 'ok']]);
    }
}