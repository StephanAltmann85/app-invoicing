<?php

declare(strict_types=1);

namespace App\Tests\Entity\Trait;

use Doctrine\Common\Collections\Collection;

trait AssociationTrait
{
    /**
     * @dataProvider provideAssociationData
     */
    public function testCollectionAssociations(?string $adder, ?string $getter, ?string $remover, ?object $value): void
    {
        $entity = (new ($this->getEntityName())());
        $entity->$adder($value);

        $this->assertInstanceOf(Collection::class, $entity->$getter());
        $this->assertEquals($value, $entity->$getter()->first());

        $entity->$remover($value);
        $this->assertEmpty($entity->$getter());
    }

    abstract public function provideAssociationData(): array;
}
