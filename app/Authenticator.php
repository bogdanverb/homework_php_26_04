<?php

namespace App;

use Nette\Security\IAuthenticator;
use Nette\Security\AuthenticationException;
use Nette\Security\Identity;

class Authenticator implements IAuthenticator
{
    /** @var UserManager */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function authenticate(array $credentials): Identity
    {
        [$username, $password] = $credentials;

        $user = $this->userManager->getUserByUsername($username);

        if (!$user) {
            throw new AuthenticationException('User not found.');
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new AuthenticationException('Invalid password.');
        }

        $roles = $user->getRoles();
        return new Identity($user->getId(), $roles);
    }
}