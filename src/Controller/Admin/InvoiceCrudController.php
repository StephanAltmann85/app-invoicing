<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Invoice;
use App\Form\InvoicePositionType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NullFilter;

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
            TextField::new('number', 'Invoice number')
                ->setDisabled()
                ->hideWhenCreating()
                ->formatValue(fn (?string $value) => $value !== null ? $value : ''),
            AssociationField::new('customer'),
            CollectionField::new('invoicePositions', 'Positions')
                ->setEntryType(InvoicePositionType::class)
                ->setEntryIsComplex()
                ->hideOnIndex(),

            TextField::new('documentFile', 'Document')
                ->setDisabled()
                ->hideWhenCreating()
                ->formatValue(fn (?string $value) => $value !== null ? $value : ''),
            DateField::new('documentCreatedAt', 'Document date')
                ->setDisabled()
                ->hideWhenCreating(),

            // TODO: listing
                // TODO: total amount
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(
                NullFilter::new('number', 'State')
                    ->setChoiceLabels('Draft', 'Completed')
            )
            ->add(
                DateTimeFilter::new('documentCreatedAt', 'DocumentDate')
            )
            ->add('customer');
    }

    public function configureActions(Actions $actions): Actions
    {
        // TODO: add create document action

        $actions
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->displayIf(
                    fn (Invoice $entity) => $entity->getNumber() === null
                );
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->displayIf(
                    fn (Invoice $entity) => $entity->getNumber() === null
                );
            });

        return parent::configureActions($actions);
    }
}
