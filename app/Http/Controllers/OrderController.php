<?php

namespace App\Http\Controllers;

use App\Interfaces\Order\IOrderRepository;
use App\Interfaces\Order\IOrderService;
use App\Interfaces\ProductVariant\IProductVariantService;
use App\Utils\EmailValidator;
use App\Utils\PhoneValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    protected $productVariantService;
    protected $orderRepository;
    protected $orderService;
    public function __construct(IProductVariantService $productVariantService, IOrderRepository $orderRepository, IOrderService $orderService)
    {
        $this->productVariantService = $productVariantService;
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }
     public function success()
     {
         if (Session::has('orderCode')) {
             return view('order.success', [
                 'title' => 'Đặt hàng thành công',
                 'orderCode' => Session::get('orderCode'),
             ]);
         } else {
             return redirect()->route('home');
         }
     }
     public function search($code)
     {
         $order = $this->orderService->getByCode($code);
         return view('order.search', [
             'title' => 'Chi tiết đơn hàng',
             'order' => $order,
         ])->with('orderService', $this->orderService);
     }
//    public function store(Request $request)
//    {
//        dd($request);
//    }
     public function store(Request $request)
     {
         $errors = [];

         $name = (string)$request->input('billing_name');
         $phoneNumber = (string)$request->input('billing_phone');
         $billing_address = (string)$request->input('billing_address');
         $ward = (string)$request->input('ward_value');
         $district = (string)$request->input('district_value');
         $province = (string)$request->input('province_value');
         $address = $billing_address .', '.$ward.', '.$district.', '.$province;
         $request->merge(['billing_address' => $address]);
         $email = (string)$request->input('billing_email');
         $payment = (string)$request->input('payment');

         if (!$name) {
             $errors['name'] = "Vui lòng nhập tên";
         }
         if (PhoneValidator::validateVietnamPhoneNumber($phoneNumber) == false) {
             $errors['phoneNumber'] = "Số điện thoại không hợp lệ";
         }
         if (EmailValidator::validateEmail($email) == false) {
             $errors['email'] = "Email không hợp lệ";
         }
         if (!$billing_address || !$ward || !$district || !$province) {
             $errors['address'] = "Vui lòng nhập địa chỉ";
         }
         if ($payment != "cash" && $payment != "momo" && $payment != "vnpay") {
             $errors['payment'] = "Phương thức thanh toán không hợp lệ";
         }

         if (!empty($errors)) {
             return redirect()->back()->withErrors($errors);
         } else {
             return $this->orderService->process($request);
         }
     }
}
