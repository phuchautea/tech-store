<?php

namespace App\Interfaces\Category;

interface ICategoryService
{
    public function getAll();
    public function getBySlug($slug);
    public function getWithProduct($limitedCategories, $limitedProducts);
}
