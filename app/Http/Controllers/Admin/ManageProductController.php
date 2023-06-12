<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Interfaces\Category\ICategoryService;
use App\Interfaces\Image\IImageService;
use App\Interfaces\Product\IProductService;
use App\Interfaces\ProductVariant\IProductVariantService;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManageProductController extends Controller
{
    protected $productService;
    protected $productVariantService;
    protected $categoryService;
    protected $imageService;


    public function __construct(IProductService $productService, IProductVariantService $productVariantService, ICategoryService $categoryService, IImageService $imageService)
    {
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $paginate = 5;
        $products = $this->productService->getAllPaginate($paginate);
        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $products,
            'total_records' => $products->total(),
        ])->with('productService', $this->productService);
    }


    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Tạo sản phẩm',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    protected function prepareVariantData($data)
    {
        $variantData = [];
        if (isset($data['variant_name'])) {
            for ($i = 0; $i < count($data['variant_name']); $i++) {
                //Upload Image
//                $jsonResponse = $this->imageService->processUpload($data['variant_image'][$i]);
//                $responseData = json_decode($jsonResponse->getContent());
//                $imagePath = $responseData->path;

                $variantData[] = [
                    'name' => $data['variant_name'][$i],
                    'quantity' => $data['variant_quantity'][$i],
                    'price' => $data['variant_price'][$i],
                    'discount_price' => $data['variant_discount_price'][$i],
                    'image' => $data['variant_image'][$i],
                    'description' => $data['variant_description'][$i],
                ];
            }
        }
        return $variantData;
    }

    protected function prepareVariantDataUpdate($data)
    {
        $variantData = [];
        foreach($data['variant_id'] as $key => $value) {
            if ($data['variant_id'][$key] == null) {
                //add
                $storeProductVariant = $this->productVariantService->store([
                    'name' => $data['variant_name'][$key],
                    'quantity' => $data['variant_quantity'][$key],
                    'price' => $data['variant_price'][$key],
                    'discount_price' => $data['variant_discount_price'][$key],
                    'image' => $data['variant_image'][$key],
                    'description' => $data['variant_description'][$key],
                    'product_id' => $data['id'],
                ]);
                $data['variant_id'][$key] = $storeProductVariant->id;
                continue;
            } else if (!isset($data['variant_name'][$key])) {
                //delete
                $removeProductVariant = $this->productVariantService->remove($data['variant_id'][$key]);
                $data['variant_id'][$key] = null;
            } else {

            }
        }

        foreach($data['variant_id'] as $key1 => $value1) {
            if($data['variant_id'][$key1] == null) {
                //skip
            }else{
                $variantData[] = [
                    'id' => $data['variant_id'][$key1],
                    'name' => $data['variant_name'][$key1],
                    'quantity' => $data['variant_quantity'][$key1],
                    'price' => $data['variant_price'][$key1],
                    'discount_price' => $data['variant_discount_price'][$key1],
                    'image' => $data['variant_image'][$key1],
                    'description' => $data['variant_description'][$key1],
                ];
            }
        }
        return $variantData;
    }

    public function store(CreateFormRequest $request)
    {
        $productData = $request->except(['variant_name', 'variant_quantity', 'variant_price', 'variant_discount_price', 'variant_image', 'variant_description']);
        $variantData = $this->prepareVariantData($request->only(['variant_name', 'variant_quantity', 'variant_price', 'variant_discount_price', 'variant_image', 'variant_description']));
        if($variantData)
        {
//            $product = $this->productService->store($productData);
//            $productId = $product->id;
//            // Lưu danh sách các variant với productId tương ứng
//            foreach ($variantData as $variant) {
//                $variant['product_id'] = $productId;
//                $this->productVariantService->store($variant);
//            }
            $this->productService->storeProductWithVariants($productData, $variantData);
        }else{
            Session::flash('error', 'Vui lòng thêm ít nhất 1 biến thể sản phẩm');
        }
        return redirect()->back();


    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chỉnh sửa danh mục: ' . $product->name,
            'product' => $product,
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function update(CreateFormRequest $request, Product $product, ProductVariant $productVariant)
    {
        $productData = $request->except(['variant_id', 'variant_name', 'variant_quantity', 'variant_price', 'variant_discount_price', 'variant_image', 'variant_description']);
        $variantData = $this->prepareVariantDataUpdate($request->only(['id', 'variant_id', 'variant_name', 'variant_quantity', 'variant_price', 'variant_discount_price', 'variant_image', 'variant_description']));
        if($variantData)
        {
            $product = $this->productService->update($request, $product);
            $productId = $product->id;
            // Lưu danh sách các variant với productId tương ứng
            foreach ($variantData as $variant) {
                $variant['product_id'] = $productId;
                $this->productVariantService->update($variant, $productVariant);
            }
            //$this->productService->updateProductWithVariants($productData, $variantData, $product);
        }else{
            Session::flash('error', 'Vui lòng thêm ít nhất 1 biến thể sản phẩm');
        }
        return redirect('admin/product/list');
        //$result = $this->productService->update($request, $product);

    }

    public function destroy(Request $request)
    {
        $result = $this->productService->remove($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Có lỗi xảy ra khi xóa sản phẩm'
        ]);
    }
}
