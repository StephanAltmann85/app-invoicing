<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\InvoicePosition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoicePositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('quantity', NumberType::class, ['scale' => 2])
            // TODO: set customer's default rate
            ->add('rate');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoicePosition::class,
        ]);
    }
}
