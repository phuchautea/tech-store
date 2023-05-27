<?php

namespace App\Interfaces\Product;

interface IProductService
{
    public function getAll();
    public function getById($id);
    public function getBySlug($slug);
    public function getProductVariants($productId);
    public function getRelatedProducts($categoryId, $productId);
    public function sortProducts($products, $sortBy);
    public function getByCategoryAndParent($categoryId);
    public function getByCategoryAndParentPaginate($categoryId, $paginate = 5);
}
