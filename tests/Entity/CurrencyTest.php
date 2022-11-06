<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Currency;
use App\Tests\Entity\Trait\ToStringTrait;

class CurrencyTest extends AbstractEntityTest
{
    use ToStringTrait;

    /**
     * @return array<array>
     */
    public function provideSetterGetterData(): array
    {
        return [
            ['setIso3', 'getIso3', 'EUR'],
            ['setSymbol', 'getSymbol', '€'],
            ['setSymbolAlignment', 'getSymbolAlignment', Currency::SYMBOL_ALIGNMENT_LEFT],
            ['setFormat', 'getFormat', 'de_DE'],
            ['setDecimals', 'getDecimals', 2],
        ];
    }

    public function stringifyEntityValues(): array
    {
        return [
            'expected' => 'TEST',
            'setter'   => [
                'setIso3' => 'TEST',
            ],
        ];
    }

    protected function getEntityName(): string
    {
        return Currency::class;
    }
}
