<?php

namespace App\Service\User;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Model\User\UserResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserServiceDefault implements UserService
{
    private UserPasswordHasherInterface $passwordHasher;

    private EntityManagerInterface $entityManager;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    public function create(UserDTO $userDTO): UserResponse
    {
        $user = new User();

        $user->setUsername($userDTO->username);
        $user->setPassword($this->passwordHasher->hashPassword($user, $userDTO->password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return UserResponse::createFromUser($user);
    }
}
