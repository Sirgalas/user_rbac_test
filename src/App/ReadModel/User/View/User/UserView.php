<?php

declare(strict_types=1);

namespace App\ReadModel\User\View\User;

use App\ReadModel\AbstractData;
use App\ReadModel\User\View\Group\GroupView;
use App\ReadModel\User\View\Role\RoleView;

class UserView extends AbstractData
{
    public $id;
    public $name;
    public $user_groups = [];
    public $user_roles = [];

    public function setUserGroups($item): void
    {
        $this->user_groups = array_map(function ($item) {
            return new GroupView($item);
        },
        json_decode("[". $item ."]", true));
    }

    public function setUserRoles($item): void
    {
        $this->user_roles = array_map(function ($item) {
            return new RoleView($item);
        },
        json_decode("[". $item ."]", true));
    }
}