<?php

declare(strict_types=1);

namespace App\UseCase\User\One;

use App\ReadModel\User\View\User\UserView;
use App\UseCase\User\AbstractUserHandler;

class UserHandler extends AbstractUserHandler
{

    public function handle(RequestData $data): UserView
    {
        return $this->userDao->getOne($data->id);
    }
}