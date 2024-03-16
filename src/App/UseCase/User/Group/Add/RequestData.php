<?php

declare(strict_types=1);

namespace App\UseCase\User\Group\Add;

use App\ReadModel\AbstractData;

class RequestData extends AbstractData
{
    public $user_id;
    public $group_id;
}