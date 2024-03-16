<?php

declare(strict_types=1);

namespace App\ReadModel\User;

use App\ReadModel\User\View\User\UserView;


class UserDao
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    final public function getAll(): array
    {
        $stmt = $this->pdo->prepare("
        SELECT
            u.id as id,
            u.name as name,
            (
                SELECT
                    group_concat(
                        json_object(
                            'id', ga.id,
                            'name', ga.name
                        )
                    )
                FROM groups_app ga
                LEFT JOIN user_groups gu ON ga.id = gu.group_id
                WHERE gu.user_id = u.id
            ) as user_groups,
                (
                    SELECT
                        group_concat(
                            json_object(
                                'id', ra.id,
                                'name', ra.name,
                                'is_blocked', rg.is_blocked
                            )
                        )
                    FROM roles_app ra
                        LEFT JOIN role_groups rg ON ra.id = rg.role_id
                        LEFT JOIN user_groups gu ON rg.group_id = gu.group_id
                    WHERE gu.user_id = u.id
                 ) as user_roles
        FROM users_app u");
        $stmt->execute([]);
        return  array_map(
            function ($item) {
                    return new UserView($item);
            },
            $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );
    }

    final public function update(int $userId, int $groupId): void
    {
        $stmt = $this->pdo->prepare('UPDATE user_groups SET user_id =:userId group_id=:groupId');
        $stmt->bindParam('userId', $userId);
        $stmt->bindParam('groupId', $groupId);
        $stmt->execute();
    }

    final public function create(int $userId, int $groupId): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO  user_groups (user_id, group_id) VALUES (:userId,:groupId)');
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':groupId', $groupId);
        $stmt->execute();
    }

    final public function delete(int $userId, int $groupId): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM user_groups WHERE user_id = :userId AND group_id = :groupId ');
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':groupId', $groupId);
        $stmt->execute();
    }

    final public function getOne(int $userId): UserView
    {
        $stmt = $this->pdo->prepare("
            SELECT
            u.id as id,
            u.name as name,
            (
                SELECT
                    group_concat(
                        json_object(
                            'id', ga.id,
                            'name', ga.name
                        )
                    )
                FROM groups_app ga
                LEFT JOIN user_groups gu ON ga.id = gu.group_id
                WHERE gu.user_id = u.id
            ) as user_groups,
            (
                SELECT
                    group_concat(
                        json_object(
                            'id', ra.id,
                            'name', ra.name,
                            'is_blocked', rg.is_blocked
                        )
                    )
                FROM roles_app ra
                    LEFT JOIN role_groups rg ON ra.id = rg.role_id
                    LEFT JOIN user_groups gu ON rg.group_id = gu.group_id
                WHERE gu.user_id = u.id
             ) as user_roles
        FROM users_app u
        where u.id = :userId
            ");
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
        return new UserView($stmt->fetch(\PDO::FETCH_ASSOC));
    }

}