<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;

class UserTest extends AbstractEntityTest
{
    /**
     * @return array<array<null|string>>
     */
    public function setterGetterProvider(): array
    {
        return [
            ['setEmail', 'getEmail', 'test@test.de'],
            ['setPassword', 'getPassword', '123456'],
        ];
    }

    protected function getEntityName(): string
    {
        return User::class;
    }
}
