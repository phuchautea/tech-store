<?php

namespace App\Services;

use App\Interfaces\Product\IProductRepository;
use App\Interfaces\Product\IProductService;
use App\Interfaces\ProductVariant\IProductVariantService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

    public function getAllPaginate($paginate)
    {
        return $this->productRepository->getAllPaginate($paginate);
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
                    $query->orderBy('price', 'asc');
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
    public function storeProductWithVariants($productData, $variantData)
    {
        $product = self::store($productData);
        if($product) {
            $productId = $product->id;
            // Lưu danh sách các variant với productId tương ứng
            foreach ($variantData as $variant) {
                $variant['product_id'] = $productId;
                $this->productVariantService->store($variant);
            }
            return true;
        }
        return false;
    }
    public function store($request)
    {
        try {
            $storeProduct = $this->productRepository->store([
                'name' => (string)$request['name'],
                'slug' => Str::slug($request['name'], '-'),
                'description' => (string)$request['description'],
                'image' => (string)$request['image'],
                'category_id' => (string)$request['category_id'],
                'status' => "1",
            ]);
            Session::flash('success', 'Thêm sản phẩm thành công');
            return $storeProduct;
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
        }
    }
    public function updateProductWithVariants($productData, $variantData, $product)
    {
        $product = self::update($productData, $product);
        if($product) {
            $productId = $product->id;
            // Lưu danh sách các variant với productId tương ứng
            foreach ($variantData as $variant) {
                $variant['product_id'] = $productId;
                $this->productVariantService->update($variant);
            }
            return true;
        }
        return false;
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->input();
        return $this->productRepository->update($data, $product);
    }

    public function remove($request)
    {
        $id = (int)$request->input('id');
        return $this->productRepository->remove($id);
    }

    public function status($status = 0): string
    {
        return $status == 0 ? '<span class="btn btn-danger btn-xs">TẮT</span>'
            : '<span class="btn btn-success btn-xs">BẬT</span>';
    }
}
