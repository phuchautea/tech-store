<?php

namespace App\Services;

use App\Interfaces\Category\ICategoryRepository;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function paginate()
    {
        return $this->categoryRepository->paginate();
    }
}