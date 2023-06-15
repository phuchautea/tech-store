<?php

namespace App\Repositories;

use App\Interfaces\OrderDetail\IOrderDetailRepository;
use App\Models\OrderDetail;

class OrderDetailRepository implements IOrderDetailRepository
{
    public function store($orderDetail)
    {
        return OrderDetail::create($orderDetail);
    }
    public function getByOrderId($orderId)
    {
        return OrderDetail::where('order_id', $orderId)->get();
    }
}
