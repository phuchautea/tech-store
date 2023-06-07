<?php

namespace App\Interfaces\Category;

use App\Models\Category;
use Illuminate\Http\Request;

interface ICategoryService
{
    public function getAll();
    public function getAllPaginate($paginate);
    public function getBySlug($slug);
    public function getWithProduct($limitedCategories, $limitedProducts);
    public function getParent();
    public function store($request);
    public function update(Request $request, Category $category);
    public function remove($request);
}
