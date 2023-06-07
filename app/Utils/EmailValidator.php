<?php

namespace App\Utils;

class EmailValidator
{
    public static function validateEmail($email) {
        $pattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
        return preg_match($pattern, $email);
    }
}
