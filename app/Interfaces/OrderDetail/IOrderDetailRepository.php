<?php

namespace App\Interfaces\OrderDetail;

interface IOrderDetailRepository
{
    public function store($orderDetail);
    public function getByOrderId($orderId);
}
