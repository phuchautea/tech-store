<?php

namespace App\Interfaces\ProductVariant;

use App\Models\ProductVariant;

interface IProductVariantService
{
    public function getById($id);
    public function getByProductId($productId);
    public function store($request);
    public function update($request, ProductVariant $productVariant);
    public function remove($request);
}
