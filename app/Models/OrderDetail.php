<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_variant_id',
        'product_variant_name',
        'price',
        'quantity',
        'total_price',
    ];
}
