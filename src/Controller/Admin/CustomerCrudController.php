<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('General'),
            TextField::new('name'),
            TextField::new('street'),
            TextField::new('additionalAddressLine'),
            TextField::new('zipCode'),
            TextField::new('city'),
            TextField::new('country'),

            FormField::addPanel('Settings'),
            // TODO: help text
            TextField::new('locale'),
            // AssociationField::new('currency')
        ];
    }
}
