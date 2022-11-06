<?php

declare(strict_types=1);

namespace App\Tests\Entity\Trait;

trait ToStringTrait
{
    public function testToString(): void
    {
        $entity = (new ($this->getEntityName())());

        $data = $this->stringifyEntityValues();

        foreach ($data['setter'] as $setter => $value) {
            $entity->$setter($value);
        }

        $this->assertEquals($data['expected'], (string) $entity);
    }

    abstract public function stringifyEntityValues(): array;
}
