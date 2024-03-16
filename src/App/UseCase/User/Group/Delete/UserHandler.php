<?php

declare(strict_types=1);

namespace App\UseCase\User\Group\Delete;

use App\UseCase\User\AbstractUserHandler;
use App\UseCase\User\Group\Add\ResponseData;

class UserHandler extends AbstractUserHandler
{
    final public function handle(RequestData $data): ResponseData
    {
        $this->userDao->delete($data->user_id, $data->group_id);
        return new ResponseData(['message' => ['status' => 'ok']]);
    }
}
