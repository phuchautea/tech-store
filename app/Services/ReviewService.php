<?php

namespace App\Services;

use App\Interfaces\Review\IReviewRepository;
use App\Interfaces\Review\IReviewService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewService implements IReviewService
{
    protected $reviewRepository;

    public function __construct(IReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getAll()
    {
        return $this->reviewRepository->getAll();
    }

    public function getByProductId($productId)
    {
        return $this->reviewRepository->getByProductId($productId);
    }

    public function store($request)
    {
        try {
            $this->reviewRepository->store([
                'title' => (string)$request['title'],
                'content' => (string)$request['content'],
                'user_id' => Auth::user()->id,
                'product_id' => $request['product_id'],
                'rating' => $request['rating'],
            ]);

            Session::flash('success', 'Thêm đánh giá thành công');
            return true;
        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage());
            return false;
        }
    }

    public function remove($request)
    {
        $id = (int)$request->input('id');
        return $this->reviewRepository->remove($id);
    }

    public function getAllPaginate($paginate = 5)
    {
        return $this->reviewRepository->getAllPaginate($paginate);
    }
}
