<?php

declare(strict_types=1);

namespace UserRbacFramework\DB;

use UserRbacFramework\DB\Exception\NotConnectionException;

class Connection
{
    protected $connection;

    public function __construct(
    ) {
        $this->connection = new \PDO('mysql:host=db;dbname=rbac_test','user','secret');
    }
}
