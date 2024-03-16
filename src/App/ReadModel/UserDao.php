<?php

declare(strict_types=1);

namespace App\ReadModel;

use App\ReadModel\View\User\UserView;


class UserDao
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->prepare('Select * from users_app');
        $stmt->execute([]);
        return  array_map(function ($item) {
                return new UserView($item);
            },
            $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );
    }
}