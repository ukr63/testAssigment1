<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

class Lead extends Validator
{
    public function validate($data): void
    {
        $errors = [];
        if (empty($data['phone'])) {
            $errors[] = 'phone is empty';
        }
        if (empty($data['first_name'])) {
            $errors[] = 'First Name is empty';
        }
        if (empty($data['last_name'])) {
            $errors[] = 'Last Name is empty';
        }
        if (empty($data['email'])) {
            $errors[] = 'email is empty';
        }
        if (empty($data['email'])) {
            $errors[] = 'Email is incorrect';
        }

        if (sizeof($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}
