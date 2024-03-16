<?php

declare(strict_types=1);

namespace App\UseCase\Group;

use App\ReadModel\Group\GroupDao;

class AbstractGroupHandler
{
    protected $groupDao;

    public function __construct(GroupDao $groupDao)
    {
        $this->groupDao = $groupDao;
    }
}