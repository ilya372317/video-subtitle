<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDTO extends DataTransferObject
{
    #[Assert\NotNull]
    #[Assert\Length(
        min: 3,
        max: 250
    )]
    public ?string $username;

    #[Assert\NotNull]
    public ?string $password;
}
