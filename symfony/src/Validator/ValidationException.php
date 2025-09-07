<?php

namespace App\Validator;

class ValidationException extends \Exception {
    public array $errors;

    public function __construct(array $errors = [], string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
