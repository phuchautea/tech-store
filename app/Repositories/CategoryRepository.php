<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Category\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    public function getAll()
    {
        return Category::all();
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

}
