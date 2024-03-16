<?php

declare(strict_types=1);

namespace Fixtures;

use App\Entity\Role;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RoleFixture implements FixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $sendMessages = new Role('send_messages');
        $manager->persist($sendMessages);
        $serviceApi = new Role('service_api');
        $manager->persist($serviceApi);
        $debug = new Role('debug');
        $manager->persist($debug);
        $manager->flush();
    }
}