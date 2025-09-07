<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

abstract class Validator
{
    /**
     * @throws ValidationException
     */
    abstract public function validate($data): void;
}
