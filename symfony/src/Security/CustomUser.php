<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;


/**
 * zaglushka
 */
class CustomUser implements UserInterface
{

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return 'blablabla';
    }
}
