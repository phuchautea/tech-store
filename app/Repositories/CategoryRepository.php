<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Category\ICategoryRepository;
use Illuminate\Support\Facades\Session;

class CategoryRepository implements ICategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function getAllPaginate($paginate)
    {
        return Category::orderBy('created_at', 'asc')->paginate($paginate);
    }

    public function getBySlug($slug)
    {
        return Category::where('slug', '=', $slug)->first();
    }

    public function getWithProduct($limitedCategories, $limitedProducts)
    {
        $categories = Category::take($limitedCategories)->get();

        foreach ($categories as $category) {
            $category->products = $category->products()->take($limitedProducts)->get();
        }

        return $categories;
    }

    public function getParent()
    {
        return Category::where('parent_id', 0)->get();
    }

    public function store($request)
    {
        return Category::create($request);
    }

    public function update($data, Category $category)
    {
        try {
            $category->updated_at = time();
            $category->fill($data);
            $category->save();
            Session::flash('success', 'Cập nhật danh mục thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function remove($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category) {
            return Category::where('id', $id)->delete();
        }
        return false;
    }
}
