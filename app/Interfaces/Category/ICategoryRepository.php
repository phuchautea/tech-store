<?php

namespace App\Interfaces\Category;

interface ICategoryRepository
{
    public function getAll();
    public function getBySlug($slug);
    public function getWithProduct($limitedCategories, $limitedProducts);
}
