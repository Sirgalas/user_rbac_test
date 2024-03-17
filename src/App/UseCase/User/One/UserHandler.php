<?php

declare(strict_types=1);

namespace App\UseCase\User\One;

use App\ReadModel\User\View\Role\RoleView;
use App\ReadModel\User\View\User\UserView;
use App\UseCase\User\AbstractUserHandler;

class UserHandler extends AbstractUserHandler
{

    public function handle(RequestData $data): UserView
    {
        $user = $this->userDao->getOne($data->id);
        $user->user_roles = $this->redactRole($user->user_roles);
        return $user;
    }

    /**
     * @param RoleView[] $roleArray
     * @return array
     */
    public function redactRole(array $roleArray): array
    {
        $idArray = [];
        foreach ($roleArray as $key => $role) {
            if ($role->is_blocked && $keysId = array_search($role->id, $idArray)) {
                unset($roleArray[$keysId]);
                continue;
            }
            if (in_array($role->id, $idArray)) {
                unset($roleArray[$key]);
                continue;
            }
            $idArray[$key] = $role->id;
        }
        return $roleArray;
    }
}
