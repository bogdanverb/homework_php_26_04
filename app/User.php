<?php

declare(strict_types=1);

namespace App;

use Nette\Security\IIdentity;

class User implements IIdentity
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getId(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        // Повертаємо список ролей користувача
        return ['admin'];
    }
}
