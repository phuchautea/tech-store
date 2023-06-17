<?php

namespace App\Interfaces\Review;

interface IReviewService
{
    public function getAll();
    public function getByProductId($productId);
    public function store($request);
    public function remove($request);
    public function getAllPaginate($paginate = 5);
}
