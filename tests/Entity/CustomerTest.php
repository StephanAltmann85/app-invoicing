<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Customer;

class CustomerTest extends AbstractEntityTest
{
    /**
     * @return array<array>
     */
    public function setterGetterProvider(): array
    {
        return [
            ['setName', 'getName', 'Name'],
            ['setStreet', 'getStreet', 'Street 1a'],
            ['setAdditionalAddressLine', 'getAdditionalAddressLine', 'Address Line 2'],
            ['setZipCode', 'getZipCode', '12345'],
            ['setCity', 'getCity', 'Berlin'],
            ['setCountry', 'getCountry', 'Germany'],
        ];
    }

    protected function getEntityName(): string
    {
        return Customer::class;
    }
}
