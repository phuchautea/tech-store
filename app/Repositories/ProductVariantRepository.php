<?php

namespace App\Repositories;

use App\Interfaces\Product\IProductRepository;
use App\Interfaces\ProductVariant\IProductVariantRepository;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class ProductVariantRepository implements IProductVariantRepository
{
    protected $productRepository;
    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getByProductId($productId)
    {
        return ProductVariant::where('product_id', $productId)->get();
    }

    public function getById($id)
    {
        return ProductVariant::find($id);
    }

    public function store($request)
    {
        return ProductVariant::create($request);
    }

    public function update($data, ProductVariant $productVariant)
    {
        try {
            $price = str_replace(',', '', (string)$data['price']);
            $discount_price = str_replace(',', '', (string)$data['discount_price']);
            $pVariant = ProductVariant::find($data['id']);

            $pVariant->name = $data['name'];
            $pVariant->quantity = $data['quantity'];
            $pVariant->price = $price;
            $pVariant->discount_price = $discount_price;
            $pVariant->description = $data['description'];
            $pVariant->image = $data['image'];

            $pVariant->save();
            return $pVariant;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function remove($id)
    {
        $product = ProductVariant::where('id', $id)->first();
        if ($product) {
            return ProductVariant::where('id', $id)->delete();
        }
        return false;
    }
}
