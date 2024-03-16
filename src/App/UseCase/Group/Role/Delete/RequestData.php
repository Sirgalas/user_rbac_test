<?php

declare(strict_types=1);

namespace App\UseCase\Group\Role\Delete;

use App\ReadModel\AbstractData;

class RequestData extends AbstractData
{
    public $role_id;
    public $group_id;

    public function setGroupId($item): void
    {
        $this->group_id = filter_var($item, FILTER_VALIDATE_INT);
    }

    public function setRoleId($item): void
    {
        $this->role_id = filter_var($item, FILTER_VALIDATE_INT);
    }
}