<?php

declare(strict_types=1);

namespace Fixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 3; $i++) {
            $user = new User($faker->name);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
