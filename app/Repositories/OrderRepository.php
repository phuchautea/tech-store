<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\Order\IOrderRepository;
use App\Utils\RandomStringGenerator;
use Illuminate\Support\Facades\Session;

class OrderRepository implements IOrderRepository
{
    public function getAll()
    {
        return Order::all();
    }

    public function getById($id)
    {
        return Order::find($id);
    }
    public function getByUserId($user_id)
    {
        return Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
    }
    public function getByCode($code)
    {
        return Order::with('user', 'orderDetails')->where('code', $code)->get();
    }
    public function store($order)
    {
        return Order::create([
            'code' => RandomStringGenerator::generateRandomString(12),
            'payment_method' => $order['payment_method'],
            'payment_status' => $order['payment_status'],
            'note' => $order['note'],
            'total_price' => $order['total_price'],
            'status' => $order['status'],
            'user_id' => $order['user_id'],
            'name' => $order['name'],
            'phoneNumber' => $order['phoneNumber'],
            'address' => $order['address'],
            'email' => $order['email']
        ]);
//        Session::flash('orderCode', $newOrder->code); //đính kèm mã order để tra cứu đơn hàng
    }
    public function getAllInfoPaginate()
    {
        return Order::with('user', 'orderDetails')->orderBy('created_at', 'desc')->paginate(10);
    }
    public function update($data, Order $order)
    {
        try {
            $order->updated_at = time();
            $order->fill($data);
            $order->save();
            Session::flash('success', 'Cập nhật đơn hàng thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}
