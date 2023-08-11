<?php

namespace App\Tests\Feature\Service\User;

use App\DTO\UserDTO;
use App\Service\User\UserServiceDefault;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserServiceTest extends KernelTestCase
{
    /**
     * @throws Exception
     */
    public function testCreatingCorrectUser(): void
    {
        // prepare
        self::bootKernel();
        $container = static::getContainer();
        $userDTO = new UserDTO(['username' => 'name', 'password' => 'password']);
        /** @var UserPasswordHasherInterface $passwordHasher */
        $passwordHasher = $container->get(UserPasswordHasherInterface::class);
        /** @var EntityManagerInterface $entityManager */
        $entityManager= $container->get(EntityManagerInterface::class);
        $sut = new UserServiceDefault($passwordHasher, $entityManager);

        // act
        $userResponse = $sut->create($userDTO);

        //assert
        $this->assertIsObject($userResponse);
        $this->assertEquals('name', $userResponse->getUsername());
    }
}
