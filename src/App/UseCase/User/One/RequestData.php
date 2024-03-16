<?php

declare(strict_types=1);

namespace App\UseCase\User\One;

use App\ReadModel\AbstractData;

class RequestData extends AbstractData
{
    public $id;

    public function setId($item): void
    {
        $this->id = (int) $item;
    }
}