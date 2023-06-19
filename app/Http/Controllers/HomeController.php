<?php

namespace App\Http\Controllers;

use App\Interfaces\Category\ICategoryService;

class HomeController extends Controller
{
    protected $categoryService;
    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $limitedCategories = 3;
        $limitedProducts = 10;
        $categoryWithProducts = $this->categoryService->getWithProduct($limitedCategories, $limitedProducts);
        $categories = $this->categoryService->getAll();
        return view('home', [
            'title' => 'Trang chủ',
            'categories' => $categories,
            'categoryWithProducts' => $categoryWithProducts,
        ]);
    }
}
