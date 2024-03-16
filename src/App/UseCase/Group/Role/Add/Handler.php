<?php

declare(strict_types=1);

namespace App\UseCase\Group\Role\Add;

use App\UseCase\Group\AbstractGroupHandler;
use App\UseCase\User\AbstractUserHandler;

class Handler extends AbstractGroupHandler
{
    public function handle(RequestData $data): ResponseData
    {
        $this->groupDao->create($data->role_id, $data->group_id, $data->is_blocked);
        return new ResponseData(['message' => ['status' => 'ok']]);
    }
}
