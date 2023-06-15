<?php

namespace App\Interfaces\Order;

use App\Models\Order;

interface IOrderRepository
{
    public function getAll();
    public function getById($id);
    public function getByCode($code);
    public function getByUserId($user_id);
    public function store($request);
    public function getAllInfoPaginate();
    public function update($data, Order $order);
}
