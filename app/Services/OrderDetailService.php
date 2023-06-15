<?php

namespace App\Services;

use App\Interfaces\OrderDetail\IOrderDetailRepository;
use App\Interfaces\OrderDetail\IOrderDetailService;
use App\Interfaces\Product\IProductRepository;
use App\Interfaces\ProductVariant\IProductVariantRepository;

class OrderDetailService implements IOrderDetailService
{
    protected $orderDetailRepository;
    protected $productRepository;
    protected $productVariantRepository;


    public function __construct(IOrderDetailRepository $orderDetailRepository,
                                IProductRepository $productRepository,
                                IProductVariantRepository $productVariantRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }
    public function store($orderDetails)
    {
        $carts = $orderDetails['carts'];
        foreach ($carts as $product_id => $variants) {
            foreach ($variants as $variant_id => $details) {

                $product = $this->productRepository->getById($product_id);
                $productVariant = $this->productVariantRepository->getById($variant_id);
                $price = $productVariant->discount_price > 0 ? $productVariant->discount_price : $productVariant->price;
                $quantity = $details['quantity'];
                $total_price = $quantity * $price;

                $orderDetail = [
                    'order_id' => $orderDetails['order_id'],
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_variant_id' => $productVariant->id,
                    'product_variant_name' => $productVariant->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total_price' => $total_price
                ];

                $orderDetails = $this->orderDetailRepository->store($orderDetail);

                if($orderDetails)
                {
                    $productVariant->decrement('quantity', $details['quantity']);
                    $productVariant->increment('sold_quantity', $details['quantity']);
                }
            }
        }
    }
    public function getByOrderId($orderId)
    {
        return $this->orderDetailRepository->getByOrderId($orderId);
    }
}
