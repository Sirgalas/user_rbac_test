<?php

declare(strict_types=1);

namespace UserRbacFramework\DB;

use PDO;
use UserRbacFramework\DB\Exception\DataBaseException;

class AbstractDao extends Connection
{
    public function execute(string $sql): void
    {
        $this->connection->exec($sql);
    }

    public function resultAll(string $sql,array $parameters): array
    {
        $sth = $this->connection->prepare($sql);
        if(!empty($parameters)) {
            array_map(
                function($item) use ($sth) {
                    $sth->bindParam($item[0],$item[1],$item[2]);
                }
                ,$parameters);
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resultOne(string $sql,array $parameters): array
    {
        $sth = $this->connection->prepare($sql);
        if(!empty($parameters)) {
            array_map(
                function($item) use ($sth) {
                    $sth->bindParam($item[0],$item[1],$item[2]);
                }
                ,$parameters);
        }
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    public function prepere(string $sql,array $parameters): void
    {
        $sth = $this->connection->prepare($sql);
        if(!empty($parameters)) {
            array_map(
                function($item) use ($sth) {
                    $sth->bindParam($item[0],$item[1],$item[2]);
                }
                ,$parameters);
        }
        try{
            $sth->execute();
        } catch (\PDOException $e) {
            throw new DataBaseException($e->getMessage(),500);
    }

    }


}