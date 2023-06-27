<?php


namespace App\Interfaces;


interface IVnpayPaymentService
{
    public function execPostRequest($url, $data);
    public function process($amount);
}


