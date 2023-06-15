<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Order\IOrderService;
use App\Interfaces\OrderDetail\IOrderDetailService;
use App\Interfaces\Product\IProductService;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class ManageOrderController extends Controller
{
    protected $productService;
    protected $orderService;
    protected $orderDetailService;
    public function __construct(IProductService $productService, IOrderService $orderService,
                                IOrderDetailService $orderDetailService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllInfoPaginate();
        $payment_status_list = [
            0 => [
                'id' => 'paid',
                'name' => 'Đã thanh toán'
            ],
            1 => [
                'id' => 'unpaid',
                'name' => 'Chưa thanh toán'
            ]
        ];
        $status_list = [
            0 => [
                'id' => 0,
                'name' => 'Chờ xác nhận'
            ],
            1 => [
                'id' => 1,
                'name' => 'Đang chuẩn bị'
            ],
            2 => [
                'id' => 2,
                'name' => 'Đang giao'
            ],
            3 => [
                'id' => 3,
                'name' => 'Hoàn thành'
            ],
            4 => [
                'id' => 4,
                'name' => 'Đã hủy'
            ]
        ];
        return view('admin.order.list', [
            'title' => 'Danh sách đơn hàng',
            'orders' => $orders,
            'total_records' => $orders->total(),
            'payment_status_list' => $payment_status_list,
            'status_list' => $status_list,
        ])->with('orderService', $this->orderService);
    }

    public function update(Request $request, Order $order)
    {
        $result = $this->orderService->update($request, $order);
        if ($result) {
            $arr_result = ['status' => true, 'message' => Session::get('success')];
        }else{
            $arr_result = ['status' => false, 'message' => Session::get('error')];
        }
        return json_encode($arr_result);
    }

}
