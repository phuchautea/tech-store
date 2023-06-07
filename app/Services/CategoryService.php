<?php

namespace App\Services;

use App\Interfaces\Category\ICategoryRepository;
use App\Interfaces\Category\ICategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

    public function getAllPaginate($paginate)
    {
        return $this->categoryRepository->getAllPaginate($paginate);
    }

    public function getBySlug($slug)
    {
        return $this->categoryRepository->getBySlug($slug);
    }

    public function getWithProduct($limitedCategories, $limitedProducts)
    {
        return $this->categoryRepository->getWithProduct($limitedCategories, $limitedProducts);
    }

    public function getParent()
    {
        return $this->categoryRepository->getParent();
    }

    public function store($request)
    {
        try {
            $this->categoryRepository->store([
                'name' => (string)$request['name'],
                'slug' => Str::slug($request['name'], '-'),
                'description' => (string)$request['description'],
                'image' => (string)$request['image'],
                'parent_id' => (string)$request['parent_id'],
                'status' => "1",
            ]);

            Session::flash('success', 'Thêm danh mục thành công');
            return true;
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return false;
        }
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->input();
        return $this->categoryRepository->update($data, $category);
    }

    public function remove($request)
    {
        $id = (int)$request->input('id');
        return $this->categoryRepository->remove($id);
    }
}
