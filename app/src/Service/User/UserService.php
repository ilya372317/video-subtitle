<?php

namespace App\Service\User;

use App\DTO\UserDTO;
use App\Model\User\UserResponse;

interface UserService
{
    public function create(UserDTO $userDTO): UserResponse;
}
