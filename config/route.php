<?php

declare(strict_types=1);

use App\Actions\Users;

$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('users', '/users', Users\Get\Action::class);
$routes->post('users_create', '/users', Users\Create\Action::class);
$routes->put('users_edit', '/users/{id}', Users\Get\Action::class);
$routes->get('users_show', '/users{id}', Users\Get\Action::class);
$routes->delete('users_delete', '/users{id}', Users\Get\Action::class);

return $aura;