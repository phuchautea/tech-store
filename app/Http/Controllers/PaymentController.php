<?php

namespace App\Http\Controllers;

use App\Interfaces\IMomoPaymentService;
use App\Interfaces\Order\IOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    protected $momoPaymentService;
    protected $orderService;
    public function __construct(IMomoPaymentService $momoPaymentService, IOrderService $orderService)
    {
        $this->momoPaymentService = $momoPaymentService;
        $this->orderService = $orderService;
    }
    public function momoResult1(Request $request)
    {
        return $this->momoPaymentService->result($request);
    }
    public function momoResult(Request $request){
        // Kiểm tra thêm từ WebHook như vậy ko an toàn
        $resultCode = $request->get('resultCode');
        if ($resultCode == '0')
        {
            $carts = Session::get('carts');
            $order = Session::get('order');
            $order['payment_status'] = 'paid';
            $order['status'] = '1';
            $this->orderService->store($order);
            return redirect('/order/success');
            // thanh toán thành công, đính kèm mã order để tra cứu, bằng session::flash
        }
        return redirect('/pay/error'); // thanh toán thất bại
    }
    public function vnpayResult(Request $request)
    {
        $vnp_HashSecret = env('vnp_HashSecret'); //Chuỗi bí mật
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($request->get('vnp_ResponseCode') == '00') {
                $carts = Session::get('carts');
                $order = Session::get('order');
                $order['payment_status'] = 'paid';
                $order['status'] = '1';
                $this->orderService->store($order);
                return redirect('/order/success');
                // thanh toán thành công, đính kèm mã order để tra cứu, bằng session::flash
            } else {
                return redirect('/pay/error'); // thanh toán thất bại (GD không thành công)
            }
        } else {
            return redirect('/pay/error'); // thanh toán thất bại (Chữ ký không hợp lệ)
        }
    }
    public function ipnMomoResult(Request $request)
    {
        return $this->paymentService->ipnMomoResult($request);
    }
    public function error()
    {
        return view('payment.error', [
            'title' => 'Thanh toán thất bại',
        ]);
    }
}
