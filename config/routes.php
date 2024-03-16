<?php

use App\Http\Action;

/** @var \Framework\Http\Application $app */

$app->get('users', '/users', Action\User\Get\Action::class);
