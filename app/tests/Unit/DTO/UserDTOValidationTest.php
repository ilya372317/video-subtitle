<?php

namespace App\Tests\DTO;

use App\DTO\UserDTO;
use App\Exception\ValidationException;
use App\Validation\Validator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserDTOValidationTest extends KernelTestCase
{
    /**
     * @throws ValidationException
     */
    public function testCorrectUserDTOValidation(): void
    {
        $validator = $this->getValidator();
        $userDTO = new UserDTO(['username' => 'username', 'password' => 'password']);

        // act
        Validator::handle($validator, $userDTO);

        // assert
        $this->assertTrue(true);
    }

    public function testUserDTOWithShortUsernameThrowException(): void
    {
        // prepare
        $validator = $this->getValidator();
        $userDTO = new UserDTO(['username' => '12', 'password' => '12345']);

        // assert
        $this->expectException(ValidationException::class);

        // act
        Validator::handle($validator, $userDTO);
    }

    public function testUserWithoutUsernameThrowException(): void
    {
        // prepare
        $validator = $this->getValidator();
        $userDTO = new UserDTO(['username' => null, 'password' => '123']);

        // assert
        $this->expectException(ValidationException::class);

        // act
        Validator::handle($validator, $userDTO);
    }

    public function testUserWithoutPasswordThrowException(): void
    {
        // prepare
        $validator = $this->getValidator();
        $userDTO = new UserDTO(['username' => 'username', 'password' => null]);

        //assert
        $this->expectException(ValidationException::class);

        //act
        Validator::handle($validator, $userDTO);
    }

    private function getValidator(): ValidatorInterface
    {
        // prepare
        static::bootKernel();
        $container = static::getContainer();
        /** @var ValidatorInterface $validator */
        $validator = $container->get(ValidatorInterface::class);
        return $validator;
    }
}
