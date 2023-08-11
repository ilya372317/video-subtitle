<?php

namespace App\Model\User;

use App\Entity\User;

class UserResponse
{
    private int $id;

    private string $username;

    public function __construct(array $properties)
    {
        $this->username = $properties['username'] ?? null;
        $this->id = $properties['id'] ?? null;
    }

    public static function createFromUser(User $user): static
    {
        return new static([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
        ]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

}
