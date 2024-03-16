<?php

declare(strict_types=1);

namespace App\ReadModel\Group\View\Group;

use App\ReadModel\AbstractData;
use App\ReadModel\Group\View\Role\RoleView;

class GroupView extends AbstractData
{
    public $id;
    public $name;
    public $group_role;

    public function setGroupRole($item): void
    {
        $this->group_role = array_map(
            function ($item) {
                return new RoleView($item);
            },
            json_decode("[". $item ."]", true)
        );
    }
}