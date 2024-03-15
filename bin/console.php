#!/usr/bin/env php
<?php

require dirname(__DIR__).'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$application = new Application();

$application->add(new \Command\InitMigration(new \UserRbacFramework\DB\AbstractDao()));
$application->run();