<?php

declare(strict_types=1);

namespace App\UseCase\User;

use App\ReadModel\User\UserDao;

class AbstractUserHandler
{
    protected $userDao;


    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }
}