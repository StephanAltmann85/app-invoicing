<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    public const SYMBOL_ALIGNMENT_LEFT  = 0;
    public const SYMBOL_ALIGNMENT_RIGHT = 1;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 3, nullable: false)]
    private string $iso3;

    #[ORM\Column(length: 10, nullable: false)]
    private string $symbol;

    #[ORM\Column]
    private int $symbolAlignment = self::SYMBOL_ALIGNMENT_LEFT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIso3(): string
    {
        return $this->iso3;
    }

    public function setIso3(string $iso3): self
    {
        $this->iso3 = $iso3;

        return $this;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getSymbolAlignment(): int
    {
        return $this->symbolAlignment;
    }

    public function setSymbolAlignment(int $symbolAlignment): self
    {
        $this->symbolAlignment = $symbolAlignment;

        return $this;
    }
}
