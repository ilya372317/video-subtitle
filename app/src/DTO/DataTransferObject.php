<?php

namespace App\DTO;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Request;

abstract class DataTransferObject
{
    #[NoReturn] public function __construct(array $properties)
    {
        $reflectionClass = new \ReflectionClass(static::class);
        $reflectionProperties = $reflectionClass->getProperties();

        foreach ($reflectionProperties as $reflectionProperty) {
            $this->{$reflectionProperty->getName()} = $properties[$reflectionProperty->getName()] ?? null;
        }
    }

    public static function createFromRequest(Request $request): static
    {
        $parameters = json_decode($request->getContent(), true);
        if (is_null($parameters)) {
            $parameters = [];
        }

        return new static($parameters);
    }
}