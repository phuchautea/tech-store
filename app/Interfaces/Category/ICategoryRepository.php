<?php

namespace App\Interfaces\Category;

use App\Models\Category;

interface ICategoryRepository
{
    public function getAll();
    public function getAllPaginate($paginate);
    public function getBySlug($slug);
    public function getWithProduct($limitedCategories, $limitedProducts);
    public function getParent();
    public function store($request);
    public function update($data, Category $category);
    public function remove($id);
}
