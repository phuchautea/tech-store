<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Review\IReviewService;
use Illuminate\Http\Request;

class ManageReviewController extends Controller
{
    protected $reviewService;
    public function __construct(IReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }
    public function index()
    {
        $reviews = $this->reviewService->getAllPaginate();
        return view('admin.review.list', [
            'title' => 'Danh sách đánh giá',
            'reviews' => $reviews,
            'total_records' => $reviews->total(),
        ])->with('reviewService', $this->reviewService);
    }
    public function destroy(Request $request)
    {
        $result = $this->reviewService->remove($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa đánh giá thành công'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Có lỗi xảy ra khi xóa đánh giá'
        ]);
    }
}
