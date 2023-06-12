<?php

namespace App\Services;

use App\Interfaces\Product\IProductRepository;
use App\Interfaces\ProductVariant\IProductVariantRepository;
use App\Interfaces\ProductVariant\IProductVariantService;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductVariantService implements IProductVariantService
{
    protected $productVariantRepository;
    protected $productRepository;

    public function __construct(IProductVariantRepository $productVariantRepository, IProductRepository $productRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
        $this->productRepository = $productRepository;
    }

    public function getByProductId($productId)
    {
        return $this->productVariantRepository->getByProductId($productId);
    }

    public function getById($id)
    {
        return $this->productVariantRepository->getById($id);
    }

    public function store($request)
    {
        try {
            $price = str_replace(',', '', (string)$request['price']);
            $discount_price = str_replace(',', '', (string)$request['discount_price']);
            $product = $this->productRepository->getById((string)$request['product_id']);

            $slug = Str::slug($request['name'], '-');
            $slugProductVariant = $product->slug .'-'.$slug;


            Session::flash('success', 'Thêm biến thể sản phẩm thành công');
            return $this->productVariantRepository->store([
                'name' => (string)$request['name'],
                'slug' => $slugProductVariant,
                'description' => (string)$request['description'],
                'image' => (string)$request['image'],
                'status' => "1",
                'quantity' => (string)$request['quantity'],
                'sold_quantity' => 0,
                'price' => $price,
                'discount_price' => $discount_price,
                'product_id' => (string)$request['product_id'],
            ]);
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return false;
        }
    }

    public function update($request, ProductVariant $productVariant)
    {
        //$data = $request->input();
        return $this->productVariantRepository->update($request, $productVariant);
    }

    public function remove($request)
    {
        if ($request instanceof Request) {
            $id = (int) $request->input('id');
        } else {
            $id = (int) $request;
        }
        return $this->productVariantRepository->remove($id);
    }
}
