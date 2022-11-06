<?php

declare(strict_types=1);

namespace App\Tests\Entity\Trait;

use App\Entity\Currency;
use App\Entity\Customer;
use App\Entity\InvoicePosition;

trait ToStringTrait
{
    public function testToString(): void
    {
        /** @var Currency|Customer|InvoicePosition $entity */
        $entity = (new ($this->getEntityName())());

        $data = $this->stringifyEntityValues();

        foreach ($data['setter'] as $setter => $value) {
            $entity->$setter($value);
        }

        $this->assertEquals($data['expected'], (string) $entity);
    }

    abstract public function stringifyEntityValues(): array;
}
