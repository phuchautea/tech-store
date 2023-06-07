<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateFormRequest;
use App\Interfaces\Category\ICategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManageCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $paginate = 5;
        $categories = $this->categoryService->getAllPaginate($paginate);
        return view('admin.category.list', [
            'title' => 'Danh sách danh mục',
            'categories' => $categories,
            'total_records' => $categories->total(),
        ])->with('categoryService', $this->categoryService);
    }

    public function create()
    {
        return view('admin.category.add', [
            'title' => 'Tạo danh mục',
            'categories' => $this->categoryService->getParent(),
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        if (!$this->categoryService->store($request)) {
            Session::flash('error', 'Đã có lỗi xảy ra! Vui lòng thử lại sau');
        }else{
            Session::flash('success', 'Thêm danh mục thành công');
        }
        return redirect()->back();
    }

    public function show(Category $category)
    {
        dd($category);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'title' => 'Chỉnh sửa danh mục: ' . $category->name,
            'category' => $category,
            'categories' => $this->categoryService->getParent()
        ]);
    }

    public function update(CreateFormRequest $request, Category $category)
    {
        $result = $this->categoryService->update($request, $category);
        return redirect('admin/category/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryService->remove($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Có lỗi xảy ra khi xóa danh mục'
        ]);
    }
}
