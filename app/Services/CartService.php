<?php

namespace App\Services;

use App\Interfaces\Cart\ICartService;
use App\Interfaces\Product\IProductService;
use App\Interfaces\ProductVariant\IProductVariantService;
use Illuminate\Support\Facades\Session;

class CartService implements ICartService
{
    protected $productService;
    protected $productVariantService;
    public function __construct(IProductService $productService, IProductVariantService $productVariantService)
    {
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }
    public function add($request)
    {
        $quantity = (int)$request->input('quantity');
        $product_id = (int)$request->input('product_id');
        $product_variant_id = (int)$request->input('product_variant_id');

        $product = $this->productService->getById($product_id);
        $product_variant = $this->productVariantService->getById($product_variant_id);

        // Kiểm tra product_variant_id có phải là của product_id không
        if ($product_variant->product_id !== $product_id) {
            Session::flash('error', 'Sản phẩm không tìm thấy hoặc không tương thích với biến thể được chọn.');
            return false;
        }

        // Kiểm tra số lượng cần mua có hợp lệ hay không
        if ($quantity <= 0) {
            Session::flash('error', 'Số lượng không hợp lệ');
            return false;
        }

        // Kiểm tra số lượng cần mua có đủ không
        if ($product_variant->quantity < $quantity) {
            Session::flash('error', 'Số lượng sản phẩm trong kho không đủ.');
            return false;
        }

        // Kiểm tra sản phẩm hợp lệ
        if ($product_id <= 0 || $product == null) {
            Session::flash('error', 'Sản phẩm không hợp lệ');
            return false;
        }

        $carts = Session::get('carts');

        if (is_null($carts)) {
            $carts = [];
        }
        if (!isset($carts[$product_id])) {
            $carts[$product_id] = [];
        }
        if (!isset($carts[$product_id][$product_variant_id])) {
            $cartItemId = md5($product_id . '-' . $product_variant_id); // tạo cartItemId mới
            $carts[$product_id][$product_variant_id] = [
                'cartItemId' => $cartItemId, // thêm cartItemId vào chi tiết giỏ hàng
                'product_id' => $product_id,
                'product_variant' => $product_variant,
                'quantity' => $quantity,
            ];
        } else {
            $carts[$product_id][$product_variant_id]['quantity'] += $quantity;
        }

        Session::put('carts', $carts);
        return true;
    }

    public function getCartItems()
    {
        $items = [];
        $carts = Session::get('carts');
        if(!empty($carts)){
            foreach ($carts as $product_id => $variants) {
                foreach ($variants as $variant_id => $details) {
                    $items[] = [
                        'cartItemId' => $details['cartItemId'],
                        'product_id' => $details['product_id'],
                        'product_details' => $this->productService->getById($details['product_id']),
                        'product_variant' => $details['product_variant'],
                        'quantity' => $details['quantity'],
                    ];
                }
            }
        }
        return $items;
    }

    public function getItemCount(){
        $count = 0;
        $carts = Session::get('carts');
        if(!empty($carts)){
            foreach ($carts as $product_id => $variants) {
                foreach ($variants as $variant_id => $details) {
                    $count += $details['quantity'];
                }
            }
        }
        return $count;
    }

    function remove($cartItemId)
    {
        $carts = Session::get('carts');
        if($cartItemId == 0) {
            Session::pull('carts');
        }else{
            foreach ($carts as $product_id => $variants) {
                foreach ($variants as $variant_id => $details) {
                    if ($details['cartItemId'] === $cartItemId) {
                        unset($carts[$product_id][$variant_id]);
                        if (empty($carts[$product_id])) {
                            unset($carts[$product_id]);
                        }
                        Session::put('carts', $carts);
                        return true;
                    }
                }
            }
            return false;
        }
        return true;
    }

    public function update($request)
    {
        $hasProductSoldOut = 0; // flag check product soldout
        $quantity = $request->input('quantity');
        foreach($quantity as $cartItemId => $newQuantity) {
            $carts = Session::get('carts');
            foreach ($carts as $product_id => $variants) {
                foreach ($variants as $variant_id => $details) {
                    if ($details['cartItemId'] === $cartItemId) {
                        $productVariant = $this->productVariantService->getById($variant_id);
                        // Kiểm tra số lượng
                        if($productVariant->quantity - $newQuantity < 0)
                        {
                            $this->remove($details['cartItemId']);
                            $hasProductSoldOut = 1;
                            continue;
                        }
                        if($newQuantity < 1) {
                            $this->remove($details['cartItemId']);
                        }else{
                            $details['quantity'] = $newQuantity;
                            $carts[$product_id][$variant_id] = $details;
                            Session::put('carts', $carts);
                        }
                    }
                }
            }
        }
        if($hasProductSoldOut == 1)
        {
            Session::flash("error", "Đã có sản phẩm không đủ số lượng tồn kho, vui lòng kiểm tra lại");
        }
        return true;
    }

}
