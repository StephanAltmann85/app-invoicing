<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\InvoicePosition;
use App\Tests\Entity\Trait\AssociationTrait;
use App\Tests\Entity\Trait\CreatedAtTrait;

class InvoiceTest extends AbstractEntityTest
{
    use AssociationTrait;
    use CreatedAtTrait;

    /**
     * @return array<array>
     */
    public function provideSetterGetterData(): array
    {
        return [
            ['setNumber', 'getNumber', '2022-0001'],
            ['setDocumentFile', 'getDocumentFile', '2022-0001.pdf'],
            ['setCustomer', 'getCustomer', new Customer()],
            ['setDocumentCreatedAt', 'getDocumentCreatedAt', new \DateTimeImmutable()],
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
        return Invoice::class;
    }
}
