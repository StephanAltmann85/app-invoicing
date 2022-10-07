<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CustomerConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerConfigurationRepository::class)]
class CustomerConfiguration
{
    // TODO: add payment deadline

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'id', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Customer $customer;

    #[ORM\Column(length: 2, nullable: false)]
    private string $locale;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Currency $currency;

    #[ORM\Column(nullable: true)]
    private ?int $rate = null;

    #[ORM\Column(nullable: true)]
    private ?float $taxRate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): CustomerConfiguration
    {
        $this->locale = $locale;

        return $this;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setTaxRate(?float $taxRate): self
    {
        $this->taxRate = $taxRate;

        return $this;
    }
}
