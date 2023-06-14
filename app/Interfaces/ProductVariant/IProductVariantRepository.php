<?php

namespace App\Interfaces\ProductVariant;

use App\Models\ProductVariant;

interface IProductVariantRepository
{
    public function getById($id);
    public function getByProductId($productId);
    public function store($request);
    public function update($data, ProductVariant $productVariant);
    public function remove($id);
}
