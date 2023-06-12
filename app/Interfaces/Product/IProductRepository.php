<?php

namespace App\Interfaces\Product;

use App\Models\Product;

interface IProductRepository
{
    public function getAll();
    public function getAllPaginate($paginate);
    public function getById($id);
    public function getBySlug($slug);
    public function getRelatedProducts($categoryId, $productId);
    public function getByCategoryAndParent($categoryId);
    public function getByCategoryAndParentPaginate($categoryId, $paginate = 5);
    public function store($request);
    public function update($data, Product $product);
    public function remove($id);
}
