<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
{
    protected function jsonException(\Exception $exception): JsonResponse
    {
        return $this->json([
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
        ], $exception->getCode());
    }
}
