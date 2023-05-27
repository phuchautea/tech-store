<?php

namespace App\Services;

use App\Interfaces\Product\IProductRepository;
use App\Interfaces\Product\IProductService;
use App\Interfaces\ProductVariant\IProductVariantService;

class ProductService implements IProductService
{
    protected $productRepository;
    protected $productVariantService;

    public function __construct(
        IProductRepository $productRepository,
        IProductVariantService $productVariantService)
    {
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function getBySlug($slug)
    {
        return $this->productRepository->getBySlug($slug);
    }

    public function getProductVariants($productId)
    {
        return $this->productVariantService->getByProductId($productId);
    }

    public function getRelatedProducts($categoryId, $productId)
    {
        return $this->productRepository->getRelatedProducts($categoryId, $productId);
    }

    public function sortProducts($products, $sortBy)
    {
        switch ($sortBy) {
            case 'price-ascending':
                return $products->load(['variants' => function ($query) {
                    $query->orderBy('price', 'asc');
                }])
                ->sortBy(function ($product) {
                    return optional($product->variants)->first()->price ?? 0;
                });
            case 'price-descending':
                return $products->load(['variants' => function ($query) {
                    $query->orderBy('price', 'desc');
                }])
                ->sortByDesc(function ($product) {
                    return optional($product->variants)->first()->price ?? 0;
                });
            case 'name-ascending':
                return $products->sortBy('name');
            case 'name-descending':
                return $products->sortByDesc('name');
            case 'created-ascending':
                return $products->sortBy('created_at');
            case 'created-descending':
                return $products->sortByDesc('created_at');
            case 'best-selling':
                return $products->load(['variants' => function ($query) {
                    $query->orderBy('sold_quantity', 'desc');
                }])
                ->sortByDesc(function ($product) {
                    return $product->variants->sum('sold_quantity');
                });
            case 'quantity-descending':
                return $products->load(['variants' => function ($query) {
                    $query->orderBy('quantity', 'desc');
                }])
                ->sortByDesc(function ($product) {
                    return $product->variants->sum('quantity');
                });
            default:
                return $products;
        }
    }
    public function getByCategoryAndParent($categoryId)
    {
        return $this->productRepository->getByCategoryAndParent($categoryId);
    }

    public function getByCategoryAndParentPaginate($categoryId, $paginate = 5)
    {
        return $this->productRepository->getByCategoryAndParentPaginate($categoryId, $paginate);
    }
}
