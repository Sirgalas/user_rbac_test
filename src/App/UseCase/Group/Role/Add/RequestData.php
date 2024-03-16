<?php

declare(strict_types=1);

namespace App\UseCase\Group\Role\Add;

use App\ReadModel\AbstractData;

class RequestData extends AbstractData
{
    public $role_id;
    public $group_id;
    public $is_blocked;

    public function setIsBlocked($item):void
    {
        $this->is_blocked = (int) $item;
    }

    public function setGroupId($item): void
    {
        $this->group_id = filter_var($item, FILTER_VALIDATE_INT);
    }

    public function setRoleId($item): void
    {
        $this->role_id = filter_var($item, FILTER_VALIDATE_INT);
    }
}
