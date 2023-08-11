<?php

namespace App\Validation;

use App\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    /**
     * @throws ValidationException
     */
    public static function handle(ValidatorInterface $validator, object $validationObject): void
    {
        $errors = $validator->validate($validationObject);
        if (count($errors) > 0) {
            throw new ValidationException((string) $errors);
        }
    }
}