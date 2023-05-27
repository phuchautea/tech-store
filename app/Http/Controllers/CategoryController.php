<?php

namespace App\Http\Controllers;

use App\Interfaces\Category\ICategoryService;
use App\Interfaces\Product\IProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $productService;

    public function __construct(ICategoryService $categoryService, IProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function showAll(Request $request)
    {
        $sortBy = $request->get('sortby');
        $products = $this->productService->getAll();

        if (!empty($sortBy)) {
            $products = $this->productService->sortProducts($products, $sortBy);
        }

        return view('category.collections', [
            'title' => 'Bộ sưu tập',
            'categories' => $this->categoryService->getAll(),
            'products' => $products,
            'breadcrumbs' => 'Tất cả sản phẩm',
        ]);
    }

    public function showByCategorySlug(Request $request, $categorySlug)
    {
        $category = $this->categoryService->getBySlug($categorySlug);
        if ($category != null) {
            $sortBy = $request->get('sortby');
            $products = $this->productService->getByCategoryAndParent($category->id);

            if (!empty($sortBy)) {
                $products = $this->productService->getByCategoryAndParentPaginate($category->id);
            }

            $products = $this->productService->sortProducts($products, $sortBy);
            return view('category.collections', [
                'title' => 'Bộ sưu tập',
                'category_info' => $category,
                'categories' => $this->categoryService->getAll(),
                'products' => $products,
                'breadcrumbs' => $category->name,
            ]);
        }
        return redirect()->route('home');
    }
}
