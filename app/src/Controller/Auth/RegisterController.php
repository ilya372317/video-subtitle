<?php

namespace App\Controller\Auth;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\inline_service;

final class RegisterController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/register', name: 'auth_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator
    ): JsonResponse {
        {
            $parameters = json_decode($request->getContent(), true);

            $user = new User();
            $password = $parameters['password'];
            $username = $parameters['username'];

            $user->setUsername($username);
            $user->setPassword($passwordHasher->hashPassword($user, $password));

            $errors = $validator->validate($user);

            if (count($errors) > 0) {
                return $this->json([
                    'errors' => $errors,
                ], 401);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->json([
                $user
            ]);
        }
    }
}
