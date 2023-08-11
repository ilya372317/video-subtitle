<?php

namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Service\User\UserService;
use App\Validation\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\DTO\UserDTO;

final class RegisterController extends BaseController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/api/register', name: 'auth_register', methods: 'POST')]
    public function register(
        Request $request,
        ValidatorInterface $validator
    ): JsonResponse {
        {
            try {
                $userDTO = UserDTO::createFromRequest($request);
                Validator::handle($validator, $userDTO);
                $user = $this->userService->create($userDTO);
                return $this->json(
                    $user
                );
            } catch (\Exception $exception) {
                return $this->jsonError($exception);
            }
        }
    }
}
