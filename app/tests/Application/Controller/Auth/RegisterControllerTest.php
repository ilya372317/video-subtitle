<?php

namespace App\Tests\Application\Controller\Auth;

use App\Controller\Auth\RegisterController;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    /**
     * @throws Exception
     */
    public function testCorrectUserRegister(): void
    {
        // prepare
        $client = static::createClient();

        // act
        $crawler = $client->request(
            'POST',
            '/api/register',
            content: json_encode(['username' => 'username', 'password' => 'password']),
        );
        // assert
        $this->assertResponseIsSuccessful();
    }

    public function testIncorrectUserRegister(): void
    {
        // prepare
        $client = static::createClient();

        // act
        $crawler = $client->request(
            'POST',
            '/api/register',
            content: json_encode(['username' => '12', 'password' => null]),

        );
        // assert
        $this->assertResponseStatusCodeSame(422);
    }
}
