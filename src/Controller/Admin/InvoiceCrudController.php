<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Invoice;
use App\Form\InvoicePositionType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InvoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invoice::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('General'),
            TextField::new('number', 'Invoice number'),
            AssociationField::new('customer'),
            // TODO: invoice number, prefilled

            CollectionField::new('invoicePositions', 'Positions')
                ->setEntryType(InvoicePositionType::class)
                ->setEntryIsComplex(),
            // TODO: add positions
        ];
    }
}
