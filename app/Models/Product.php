<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function hasStock()
    {
        return $this->variants()->sum('quantity') > 0;
    }
    public function hasDiscount()
    {
        return $this->variants()->sum('discount_price') > 0;
    }
    
    public function maxDiscountPercentage()
    {
        $variants = $this->variants()->where('discount_price', '>', 0)->orderByDesc('discount_price')->get();
        $maxDiscountPercentage = 0;
        if ($variants->count() > 0) {
            foreach($variants as $variant) {
                $maxDiscountVariant = $variant;
                $price = $maxDiscountVariant->price;
                $discountPrice = $maxDiscountVariant->discount_price;
                $discountPercentage = round((($price - $discountPrice) / $price) * 100);
                if($discountPercentage > $maxDiscountPercentage) {
                    $maxDiscountPercentage = $discountPercentage;
                }
            }
        }

        return $maxDiscountPercentage;
    }



}
