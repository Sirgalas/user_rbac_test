<?php

declare(strict_types=1);

namespace App\UseCase\User\Group\Delete;

use App\ReadModel\AbstractData;

class RequestData extends AbstractData
{
    public $user_id;
    public $group_id;

    public function setUserId($item): void
    {
        $this->user_id = filter_var($item, FILTER_VALIDATE_INT);
    }

    public function setGroupId($item): void
    {
        $this->group_id = filter_var($item, FILTER_VALIDATE_INT);
    }
}
