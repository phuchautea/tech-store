<?php

namespace App\Services;

use App\Interfaces\Category\ICategoryRepository;
use App\Interfaces\Category\ICategoryService;

class CategoryService implements ICategoryService
{
    protected $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getBySlug($slug)
    {
        return $this->categoryRepository->getBySlug($slug);
    }

    public function getWithProduct($limitedCategories, $limitedProducts)
    {
        return $this->categoryRepository->getWithProduct($limitedCategories, $limitedProducts);
    }
}
