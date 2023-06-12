<?php

namespace App\Http\Controllers;

use App\Interfaces\Product\IProductService;
use App\Interfaces\Review\IReviewService;

class ProductController extends Controller
{
    protected $productService;
    protected $reviewService;
    public function __construct(IProductService $productService, IReviewService $reviewService)
    {
        $this->productService = $productService;
        $this->reviewService = $reviewService;
    }
    public function showBySlug($slug)
    {
        $product = $this->productService->getBySlug($slug);
        $product_variants = $this->productService->getProductVariants($product->id);
        $related_products = $this->productService->getRelatedProducts($product->category_id, $product->id);
        $reviews = $this->reviewService->getByProductId($product->id);
        if ($product != null) {

            return view('product.details', [
                'title' => 'Sản phẩm: ' . $product->name . '',
                'product' => $product,
                'product_variants' => $product_variants,
                'related_products' => $related_products,
                'reviews' => $reviews,
                'breadcrumbs' => $product->name,
            ]);
        }
        return redirect()->route('home');
    }
}
