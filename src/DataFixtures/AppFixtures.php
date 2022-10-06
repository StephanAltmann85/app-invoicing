<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $loader   = new NativeLoader();
        $fixtures = $loader->loadFile(__DIR__ . '/../../fixtures/AppFixtures.yaml');

        foreach ($fixtures->getObjects() as $fixture) {
            $manager->persist($fixture);
        }

        $manager->flush();
    }
}
