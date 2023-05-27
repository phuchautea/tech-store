<?php

namespace App\Interfaces\Product;

interface IProductRepository
{
    public function getAll();
    public function getById($id);
    public function getBySlug($slug);
    public function getRelatedProducts($categoryId, $productId);
    public function getByCategoryAndParent($categoryId);
    public function getByCategoryAndParentPaginate($categoryId, $paginate = 5);
}
