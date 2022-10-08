<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures;

use App\DataFixtures\AppFixtures;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

class AppFixturesTest extends TestCase
{
    public function testLoad(): void
    {
        $manager = $this->createMock(ObjectManager::class);

        $manager
            ->expects($this->atLeastOnce())
            ->method('persist');

        $manager
            ->expects($this->once())
            ->method('flush');

        $appFixtures = new AppFixtures();
        $appFixtures->load($manager);
    }
}
