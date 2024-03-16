<?php

declare(strict_types=1);

namespace App\ReadModel\Group;

use App\ReadModel\Group\View\Group\GroupView;
use App\ReadModel\User\View\User\UserView;

class GroupDao
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
            g.id as id,
            g.name as name,
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
                WHERE rg.group_id = g.id
            ) as group_role
        FROM groups_app g
            ");
        $stmt->execute();
        return array_map(
            function ($item) {
                return new GroupView($item);
            },
            $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );
    }

    final public function create(int $roleId, int $groupId, ?int $isBlocked = 0): void
    {
        $isBlocked = $isBlocked ?? 0;
        $stmt = $this->pdo->prepare('
            INSERT INTO  role_groups (role_id, group_id, is_blocked) 
            VALUES (:roleId,:groupId,:isBlocked)
        ');
        $stmt->bindParam(':roleId', $roleId);
        $stmt->bindParam(':groupId', $groupId);
        $stmt->bindParam(':isBlocked', $isBlocked);
        $stmt->execute();
    }

    final public function delete(int $roleId, int $groupId): void
    {
        $stmt = $this->pdo->prepare('
            DELETE FROM role_groups 
                   WHERE role_id = :roleId
                     AND group_id = :groupId ');
        $stmt->bindParam(':roleId', $roleId);
        $stmt->bindParam(':groupId', $groupId);
        $stmt->execute();
    }
}
