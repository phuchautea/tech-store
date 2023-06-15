<?php

namespace App\Interfaces\Order;

use App\Models\Order;
use Illuminate\Http\Request;

interface IOrderService
{
    public function getAll();
    public function getById($id);
    public function getByCode($code);
    public function getByUserId($user_id);
    public function status($status);
    public function payment_status($status);
    public function process($order);
    public function store($order);
    public function getAllInfoPaginate();
    public function update(Request $request, Order $order);
}
