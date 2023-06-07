<?php

namespace App\Utils;

class PhoneValidator
{
    public static function validateVietnamPhoneNumber($phoneNumber) {
        $pattern = '/^(\\+?84|0)(86|96|97|98|32|33|34|35|36|37|38|39|91|94|83|84|85|81|82|90|93|70|79|77|76|78|92|56|58|99|59|55|87)\\d{7}$/';
        return preg_match($pattern, $phoneNumber);
    }
}
