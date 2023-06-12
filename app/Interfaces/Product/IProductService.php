<?php

namespace App\Interfaces\Product;

use App\Models\Product;
use Illuminate\Http\Request;

interface IProductService
{
    public function getAll();
    public function getAllPaginate($paginate);
    public function getById($id);
    public function getBySlug($slug);
    public function getProductVariants($productId);
    public function getRelatedProducts($categoryId, $productId);
    public function sortProducts($products, $sortBy);
    public function getByCategoryAndParent($categoryId);
    public function getByCategoryAndParentPaginate($categoryId, $paginate = 5);
    public function storeProductWithVariants($productData, $variantData);
    public function store($request);
    public function update(Request $request, Product $product);
    public function remove($request);
    public function status($status);
}
