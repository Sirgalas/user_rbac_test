<?php

use App\Http\Action;

/** @var \Framework\Http\Application $app */

/** ## USER ROUTE */
$app->get(
    'user',
    '/users',
    Action\User\Get\Action::class
);
$app->get(
    'user_one',
    '/users/{id}',
    Action\User\One\Action::class
);
$app->post(
    'user_add_group',
    '/users/group',
    Action\User\Group\Add\Action::class
);
$app->delete(
    'user_delete_group',
    '/users/group/{user_id}/{group_id}',
    Action\User\Group\Delete\Action::class
);

/** ## GROUP ROUTE */
$app->get(
    'groups',
    '/groups',
    Action\Group\Get\Action::class
);
$app->post(
    'group_add_role',
    '/groups/role',
    App\Http\Action\Group\Role\Add\Action::class
);
$app->delete(
    'group_delete_role',
    '/groups/role/{role_id}/{group_id}',
    App\Http\Action\Group\Role\Delete\Action::class
);
