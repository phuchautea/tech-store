<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'payment_method',
        'payment_status',
        'note',
        'total_price',
        'status',
        'user_id',
        'name',
        'phoneNumber',
        'address',
        'email'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
