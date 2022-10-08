<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\Entity;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Doctrine\ManagerRegistry;

abstract class AbstractEntityTest extends TestCase
{
    protected const DEFAULT_TEST_ID = 100;

    /**
     * TODO: construct args
     *
     * @dataProvider provideSetterGetterData
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

    public function testRepositoryInstantiation(): void
    {
        $registry      = $this->createMock(ManagerRegistry::class);
        $objectManager = $this->createMock(EntityManagerInterface::class);

        $registry
            ->expects($this->once())
            ->method('getManagerForClass')
            ->willReturn($objectManager);

        $objectManager
            ->expects($this->once())
            ->method('getClassMetadata')
            ->willReturn(new ClassMetadata($this->getEntityName()));

        $reflection      = new \ReflectionClass($this->getEntityName());
        $repositoryClass = $reflection->getAttributes(Entity::class)[0]->getArguments()['repositoryClass'];

        $repository = new $repositoryClass($registry);

        $this->assertInstanceOf($repositoryClass, $repository);
    }

    abstract public function provideSetterGetterData(): array;

    /**
     * @return class-string
     */
    abstract protected function getEntityName(): string;
}
