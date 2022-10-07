<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;

class UserTest extends AbstractEntityTest
{
    /**
     * @return array<array>
     */
    public function setterGetterProvider(): array
    {
        return [
            ['setEmail', 'getEmail', 'test@test.de'],
            ['setEmail', 'getUserIdentifier', 'test@test.de'],
            ['setPassword', 'getPassword', '123456'],
            ['setRoles', 'getRoles', ['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']],
        ];
    }

    protected function getEntityName(): string
    {
        return User::class;
    }
}
