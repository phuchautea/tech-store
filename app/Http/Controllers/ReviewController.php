<?php

namespace App\Http\Controllers;

use App\Interfaces\Review\IReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    protected $reviewService;
    public function __construct(IReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'product_id' => 'required|int',
            'rating' => 'required|int|between:1,5'
        ]);

        if ($this->reviewService->store($validatedData)) {
            Session::flash('success', 'Thêm đánh giá thành công');
        }else{
            //Session::flash('error', 'Đã có lỗi xảy ra! Vui lòng thử lại sau');
        }

        return redirect()->back();
    }
}
