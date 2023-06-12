<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\Product\IProductRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductRepository implements IProductRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function getAllPaginate($paginate)
    {
        return Product::orderBy('created_at', 'asc')->paginate($paginate);
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

    public function store($request)
    {
        return Product::create($request);
    }

    public function update($data, Product $product)
    {
        try {
            $product->fill($data);
            $product->slug = Str::slug($data['name'], "-");
            $product->updated_at = time();
            $product->save();
            Session::flash('success', 'Cập nhật sản phẩm thành công');
            return $product;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function remove($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            return Product::where('id', $id)->delete();
        }
        return false;
    }
}
