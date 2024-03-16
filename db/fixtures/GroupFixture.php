<?php

declare(strict_types=1);

namespace Fixtures;

use App\Entity\Group;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GroupFixture implements FixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 4; $i++) {
            $group = new Group($faker->word());
            $manager->persist($group);
        }
        $manager->flush();
    }
}