<?php

declare(strict_types=1);

use App\Actions\Users;

$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('users', '/users', new Users\Get\Action::class);
$routes->post('users_create', '/users', new Users\Create\Action::class);
$routes->put('users_edit', '/users/{id}', new Users\Get\Action::class);
$routes->get('users_show', '/users{id}', new Users\Get\Action::class);
$routes->delete('users_delete', '/users{id}', new Users\Get\Action::class)->tokens(['id' => '\id']);

return $aura;