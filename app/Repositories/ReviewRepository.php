<?php

namespace App\Repositories;

use App\Models\Review;
use App\Interfaces\Review\IReviewRepository;

class ReviewRepository implements IReviewRepository
{
    public function getAll()
    {
        return Review::all()->sortByDesc('created_at');
    }

    public function getByProductId($productId)
    {
        return Review::where('product_id', $productId)->get()->sortByDesc('created_at');
    }

    public function store($request)
    {
        return Review::create($request);
    }
    public function remove($id)
    {
        $review = Review::where('id', $id)->first();
        if ($review) {
            return Review::where('id', $id)->delete();
        }
        return false;
    }

    public function getAllPaginate($paginate = 5)
    {
        return Review::orderBy('created_at', 'desc')->paginate($paginate);
    }
}
