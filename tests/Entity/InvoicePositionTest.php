<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\InvoicePosition;
use App\Tests\Entity\Trait\AssociationTrait;
use App\Tests\Entity\Trait\CreatedAtTrait;
use App\Tests\Entity\Trait\ToStringTrait;

class InvoicePositionTest extends AbstractEntityTest
{
    use ToStringTrait;

    /**
     * @return array<array>
     */
    public function provideSetterGetterData(): array
    {
        return [
            ['setDescription', 'getDescription', 'Position 1'],
            ['setQuantity', 'getQuantity', 2.25],
            ['setInvoice', 'getInvoice', new Invoice()],
            ['setRate', 'getRate', 8000],
        ];
    }

    public function provideAssociationData(): array
    {
        return [
            ['addInvoicePosition', 'getInvoicePositions', 'removeInvoicePosition', new InvoicePosition()],
        ];
    }

    protected function getEntityName(): string
    {
        return InvoicePosition::class;
    }

    public function stringifyEntityValues(): array
    {
        return [
            'expected' => 'TEST (2.25)',
            'setter' => [
                'setDescription' => 'TEST',
                'setQuantity' => 2.25
            ]
        ];
    }
}
