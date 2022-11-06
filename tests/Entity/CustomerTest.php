<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Currency;
use App\Entity\Customer;
use App\Entity\Invoice;
use App\Tests\Entity\Trait\AssociationTrait;
use App\Tests\Entity\Trait\ToStringTrait;

class CustomerTest extends AbstractEntityTest
{
    use AssociationTrait;
    use ToStringTrait;

    /**
     * @return array<array>
     */
    public function provideSetterGetterData(): array
    {
        return [
            ['setName', 'getName', 'Name'],
            ['setStreet', 'getStreet', 'Street 1a'],
            ['setLocale', 'getLocale', 'de'],
            ['setTaxRate', 'getTaxRate', 19],
            ['setCurrency', 'getCurrency', new Currency()],
            ['setDefaultRate', 'getDefaultRate', 8000],
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

    public function stringifyEntityValues(): array
    {
        return [
            'expected' => 'TEST',
            'setter'   => [
                'setName' => 'TEST',
            ],
        ];
    }

    protected function getEntityName(): string
    {
        return Customer::class;
    }
}
