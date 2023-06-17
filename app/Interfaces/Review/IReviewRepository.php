<?php

namespace App\Interfaces\Review;

interface IReviewRepository
{
    public function getAll();
    public function getByProductId($productId);
    public function store($request);
    public function remove($id);
    public function getAllPaginate($paginate = 5);
}
