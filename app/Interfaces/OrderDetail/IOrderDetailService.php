<?php

namespace App\Interfaces\OrderDetail;

interface IOrderDetailService
{
    public function store($orderDetails);
    public function getByOrderId($orderId);
}
