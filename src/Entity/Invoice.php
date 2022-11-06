<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\InvoiceRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('number')]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // TODO: set on invoice render, incrementor
    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $number;

    // TODO: set on invoice render
    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $documentFile;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $documentCreatedAt = null;

    /**
     * @var Collection<int,InvoicePosition>
     */
    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: InvoicePosition::class, cascade: ['persist'])]
    private Collection $invoicePositions;

    public function __construct()
    {
        $this->invoicePositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDocumentFile(): ?string
    {
        return $this->documentFile;
    }

    public function setDocumentFile(string $documentFile): Invoice
    {
        $this->documentFile = $documentFile;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDocumentCreatedAt(): ?DateTimeImmutable
    {
        return $this->documentCreatedAt;
    }

    public function setDocumentCreatedAt(?DateTimeImmutable $documentCreatedAt): Invoice
    {
        $this->documentCreatedAt = $documentCreatedAt;

        return $this;
    }

    /**
     * @return Collection<int, InvoicePosition>
     */
    public function getInvoicePositions(): Collection
    {
        return $this->invoicePositions;
    }

    public function addInvoicePosition(InvoicePosition $invoicePosition): self
    {
        if (!$this->invoicePositions->contains($invoicePosition)) {
            $this->invoicePositions->add($invoicePosition);
            $invoicePosition->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoicePosition(InvoicePosition $invoicePosition): self
    {
        if ($this->invoicePositions->removeElement($invoicePosition)) {
            // set the owning side to null (unless already changed)
            if ($invoicePosition->getInvoice() === $this) {
                $invoicePosition->setInvoice(null);
            }
        }

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }
}
