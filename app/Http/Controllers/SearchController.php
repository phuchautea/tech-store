<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $paginate = 8;
        $query = $request->input('q');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate($paginate);
        // Lấy tất cả các tham số từ query url
        $queryParams = $request->query();
        // Đính kèm các tham số vào phân trang
        $products->appends($queryParams);
        return view('search', [
            'products' => $products,
            'query' => $query,
        ]);
    }
}
