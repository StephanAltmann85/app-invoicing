<?php

declare(strict_types=1);

namespace App\Tests\Entity\Trait;

trait CreatedAtTrait
{
    public function testGetCreatedAt(): void
    {
        $reflectionClass = new \ReflectionClass($this->getEntityName());
        $entity          = (new ($this->getEntityName())());

        $reflectionProperty = $reflectionClass->getProperty('createdAt');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($entity, new \DateTimeImmutable(self::DEFAULT_TEST_DATE));

        /** @phpstan-ignore-next-line */
        $createdAt = $entity->getCreatedAt();

        $this->assertEquals(new \DateTimeImmutable(self::DEFAULT_TEST_DATE), $createdAt);
    }

    public function testsetCreatedAtValue(): void
    {
        $entity = (new ($this->getEntityName())());
        /** @phpstan-ignore-next-line */
        $this->assertNull($entity->getCreatedAt());
        /** @phpstan-ignore-next-line */
        $entity->setCreatedAtValue();
        /** @phpstan-ignore-next-line */
        $this->assertNotNull($entity->getCreatedAt());
    }
}
