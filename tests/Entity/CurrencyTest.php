<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Currency;

class CurrencyTest extends AbstractEntityTest
{
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

    protected function getEntityName(): string
    {
        return Currency::class;
    }
}
