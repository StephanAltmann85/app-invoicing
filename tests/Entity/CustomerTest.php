<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Tests\Entity\Trait\AssociationTrait;

class CustomerTest extends AbstractEntityTest
{
    use AssociationTrait;

    /**
     * @return array<array>
     */
    public function provideSetterGetterData(): array
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

    public function provideAssociationData(): array
    {
        return [
            ['addInvoice', 'getInvoices', 'removeInvoice', new Invoice()],
        ];
    }

    protected function getEntityName(): string
    {
        return Customer::class;
    }
}
