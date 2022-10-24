<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\InvoicePositionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoicePositionsRepository::class)]
class InvoicePosition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'invoicePositions')]
    private ?Invoice $invoice = null;

    #[ORM\Column(length: 255, nullable: false)]
    private string $description;

    #[ORM\Column(nullable: false)]
    private float $quantity = 1;

    #[ORM\Column(nullable: false)]
    private int $rate;

    public function __toString(): string
    {
        //TODO: constants for format
        return sprintf('%s (%.02f)', $this->description, $this->quantity, 2);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRate(): int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
