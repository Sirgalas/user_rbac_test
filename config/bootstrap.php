<?php

declare(strict_types=1);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    \UserRbacFramework\DB\AbstractDao::class => \DI\create()
        ->constructor('localhost',
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_DATABASE'),
            getenv('DB_DATABASE')
        ),
];