<?php

declare(strict_types=1);

namespace App\Tests\Form;

use App\Entity\InvoicePosition;
use App\Form\InvoicePositionType;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoicePositionTypeTest extends TestCase
{
    /** @var FormBuilderInterface&MockObject */
    private FormBuilderInterface $formBuilder;
    /** @var MockObject&OptionsResolver */
    private OptionsResolver $optionsResolver;

    public function setUp(): void
    {
        $this->formBuilder     = $this->createMock(FormBuilderInterface::class);
        $this->optionsResolver = $this->createMock(OptionsResolver::class);
    }

    public function testBuildForm(): void
    {
        $type = new InvoicePositionType();

        $this->formBuilder
            ->expects($this->exactly(3))
            ->method('add')
            ->withConsecutive(['description'], ['quantity', NumberType::class, ['scale' => 2]], ['rate'])
            ->willReturn($this->formBuilder);

        $type->buildForm($this->formBuilder, []);
    }

    public function testConfigureOptionsm(): void
    {
        $type = new InvoicePositionType();

        $this->optionsResolver
            ->expects($this->once())
            ->method('setDefaults')
            ->with(['data_class' => InvoicePosition::class]);

        $type->configureOptions($this->optionsResolver);
    }
}
