<?php

namespace App\Security;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class MantisPasswordProvider implements PasswordHasherInterface
{
    public function hash(string $plainPassword, ?string $salt = null): string
    {
        return md5($plainPassword);
    }

    public function verify(string $hashedPassword, string $plainPassword, ?string $salt = null): bool
    {
        return $hashedPassword === md5($plainPassword);
    }

    public function needsRehash(string $hashedPassword): bool
    {
        return false;
    }
}
