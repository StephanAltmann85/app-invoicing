<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;

abstract class AbstractEntityTest extends TestCase
{
    protected const DEFAULT_TEST_ID = 100;

    /**
     * TODO: construct args
     *
     * @dataProvider setterGetterProvider
     */
    public function testSetterGetter(string $setter, string $getter, float|int|object|string|array $value): void
    {
        $entity = (new ($this->getEntityName())())->{$setter}($value);

        $this->assertEquals($value, $entity->{$getter}());
    }

    public function testGetId(): void
    {
        $reflectionClass = new \ReflectionClass($this->getEntityName());
        $entity          = (new ($this->getEntityName())());

        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($entity, self::DEFAULT_TEST_ID);

        /** @phpstan-ignore-next-line */
        $id = $entity->getId();

        $this->assertEquals(self::DEFAULT_TEST_ID, $id);
    }

    abstract public function setterGetterProvider(): array;

    /**
     * @return class-string
     */
    abstract protected function getEntityName(): string;
}
