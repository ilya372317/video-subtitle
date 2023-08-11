<?php

namespace App\Exception;

use Exception;

class ValidationException extends Exception
{
    protected $message = 'Failed to validate object';

    protected $code = 422;
}