<?php

declare(strict_types=1);

namespace App\ReadModel\Group\View\Role;

use App\ReadModel\AbstractData;

class RoleView extends AbstractData
{
    public $id;
    public $name;
    public $is_blocked;

    public function setIsBlocked($item): void
    {
        $this->is_blocked = (bool)$item;
    }
}