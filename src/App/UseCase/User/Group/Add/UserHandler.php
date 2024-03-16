<?php

declare(strict_types=1);

namespace App\UseCase\User\Group\Add;

use App\UseCase\User\AbstractUserHandler;

class UserHandler extends AbstractUserHandler
{

    final public function handler(RequestData $data): ResponseData
    {
        $this->userDao->create($data->user_id, $data->group_id);
        return new ResponseData(['message' => ['status' => 'ok']]);
    }
}