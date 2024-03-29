<?php

use Doctrine\DBAL\Driver\PDO\MySQL\Driver;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;

return [
    'dependencies' => [
        'factories'  => [
            EntityManagerInterface::class => ContainerInteropDoctrine\EntityManagerFactory::class,
        ],
    ],

    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driver_class' => Driver::class,
                'pdo' => PDO::class,
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => MappingDriverChain::class,
                'drivers' => [
                    'App\Entity' => 'entities',
                ],
            ],
            'entities' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => ['src/App/Entity'],
            ],
        ],
    ],
];
