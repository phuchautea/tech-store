<?php

namespace App\Interfaces;

interface IMomoPaymentService
{
    public function execPostRequest($url, $data);
    public function process($amount);
}
