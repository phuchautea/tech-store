<?php

namespace App\Services;

use App\Interfaces\Cart\ICartService;
use App\Interfaces\IMomoPaymentService;
use App\Interfaces\IVnpayPaymentService;
use App\Interfaces\Order\IOrderRepository;
use App\Interfaces\Order\IOrderService;
use App\Interfaces\OrderDetail\IOrderDetailService;
use App\Interfaces\ProductVariant\IProductVariantService;
use App\Mail\OrderSuccessMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderService implements IOrderService
{
    protected $orderRepository;
    protected $cartService;
    protected $productVariantService;
    protected $orderDetailService;
    protected $momoPaymentService;
    protected $vnpayPaymentService;

    public function __construct(IOrderRepository $orderRepository, ICartService $cartService,
                                IProductVariantService $productVariantService, IOrderDetailService $orderDetailService,
                                IMomoPaymentService $momoPaymentService, IVnpayPaymentService $vnpayPaymentService)
    {
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        $this->productVariantService = $productVariantService;
        $this->orderDetailService = $orderDetailService;
        $this->momoPaymentService = $momoPaymentService;
        $this->vnpayPaymentService = $vnpayPaymentService;
    }

    public function getAll()
    {
        return $this->orderRepository->getAll();
    }

    public function getById($id)
    {
        return $this->orderRepository->getById($id);
    }
    public function getByCode($code)
    {
        return $this->orderRepository->getByCode($code);
    }
    public function getByUserId($user_id)
    {
        return $this->orderRepository->getByUserId($user_id);
    }
    public function status($status = 0): string
    {
        switch ($status) {
            case 1:
                return '<b style="color: #007bff;">ĐANG CHUẨN BỊ</b>';
                break;
            case 2:
                return '<b style="color: #ffc107;">ĐANG GIAO</b>';
                break;
            case 3:
                return '<b style="color: #28a745;">HOÀN THÀNH</b>';
                break;
            case 4:
                return '<b style="color: #dc3545;">ĐÃ HỦY</b>';
                break;
            default:
                return '<b style="color: #17a2b8;">CHỜ XÁC NHẬN</b>';
                break;
        }
    }
    public function payment_status($status = 0): string
    {
        return $status == 'paid' ? '<b style="color: #28a745;">ĐÃ THANH TOÁN</b>'
            : '<b style="color: #dc3545;">CHƯA THANH TOÁN</b>';
    }
    public function process($request)
    {
        $name = (string)$request->input('billing_name');
        $phoneNumber = (string)$request->input('billing_phone');
        $address = (string)$request->input('billing_address');
        $email = (string)$request->input('billing_email');
        $note = (string)$request->input('billing_notes');
        $payment = (string)$request->input('payment');
        Auth::check() ? $user_id = Auth::user()->id : $user_id = null;

        try {
            // Lấy tổng tiền từ giỏ hàng
            $carts = Session::get("carts");
            $total_price = 0;
            $hasProductSoldOut = 0; // flag check product soldout
            // Kiểm tra giỏ hàng
            if(!empty($carts)) {
                foreach ($carts as $product_id => $variants) {
                    foreach ($variants as $variant_id => $details) {
                        $productVariant = $this->productVariantService->getById($variant_id);
                        // Kiểm tra số lượng
                        if($productVariant->quantity - $details['quantity'] < 0)
                        {
                            $this->cartService->remove($details['cartItemId']);
                            $hasProductSoldOut = 1;
                            continue;
                        }
                        //Tính tổng tiền
                        if($productVariant->discount_price > 0) {
                            $price = explode('.', $productVariant->discount_price);
                        }else{
                            $price = explode('.', $productVariant->price);
                        }
                        $total_price += $price[0] * $details['quantity'];
                    }
                }
            }

            if($hasProductSoldOut == 1)
            {
                Session::flash("error", "Đã có sản phẩm không đủ số lượng tồn kho, vui lòng kiểm tra lại");
                return redirect('/carts');
            }

            // Lưu thông tin order lên session
            $order = Session::get("order"); // lưu thông tin về order
            $order['note'] = $note;
            $order['payment_method'] = $payment;
            $order['payment_status'] = 'unpaid';
            $order['total_price'] = $total_price;
            $order['user_id'] = $user_id;
            $order['name'] = $name;
            $order['phoneNumber'] = $phoneNumber;
            $order['address'] = $address;
            $order['email'] = $email;
            Session::put("order", $order);
            // thêm phương thức thanh toán vào session['payment'] và chuyển tới phương thức thanh toán
            switch ($payment) {
                case "momo":
                    return $this->momoPaymentService->process($total_price);
                    break;
                case "vnpay":
                    return $this->vnpayPaymentService->process($total_price);
                    break;
                default:
                    // add order, trạng thái chưa thanh toán, xóa session cart
                    $order['status'] = '0';
                    return self::store($order);
                    break;
            }
            Session::flash('success', 'Tạo đơn hàng thành công');
            Log::info("Order thành công");
            return true;
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            Log::info($ex->getMessage());
            return false;
        }
    }
    public function store($order)
    {
        $carts = Session::get("carts");
        $newOrder = $this->orderRepository->store($order); // Thêm vào order

        if ($newOrder) {
            Session::flash('orderCode', $newOrder->code); // Đính kèm mã order để tra cứu đơn hàng
            $order_details = [];
            $order_details['carts'] = $carts;
            $order_details['order_id'] = $newOrder->id;
            $this->orderDetailService->store($order_details);
            $this->cartService->remove(0); // xóa hết giỏ hàng
            Session::pull('order');
            Mail::to($newOrder->email)->send(new OrderSuccessMail($newOrder, $this->orderDetailService));

            return redirect('/order/success');
        }else{
            return redirect('/carts');
        }
    }

    public function getAllInfoPaginate()
    {
        return $this->orderRepository->getAllInfoPaginate();
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->input();
        return $this->orderRepository->update($data, $order);
    }

}
