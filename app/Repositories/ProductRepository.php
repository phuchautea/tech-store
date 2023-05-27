<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\Product\IProductRepository;

class ProductRepository implements IProductRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function getBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }

    public function getRelatedProducts($categoryId, $productId)
    {
        return Product::where('category_id', $categoryId)
            ->where('id', '!=', $productId)
            ->get();
    }

    public function getByCategoryAndParent($categoryId)
    {
        return Product::where('category_id', $categoryId)
            ->orWhere(function ($query) use ($categoryId) {
                $query->whereIn('category_id', function ($query) use ($categoryId) {
                    $query->select('id')
                        ->from('categories')
                        ->where('parent_id', $categoryId);
                })->where('category_id', '<>', $categoryId);
            })->get();
    }

    public function getByCategoryAndParentPaginate($categoryId, $paginate = 5)
    {
        return Product::where('category_id', $categoryId)
            ->orWhere(function ($query) use ($categoryId) {
                $query->whereIn('category_id', function ($query) use ($categoryId) {
                    $query->select('id')
                        ->from('categories')
                        ->where('parent_id', $categoryId);
                })->where('category_id', '<>', $categoryId);
            })->paginate($paginate);
    }
}
