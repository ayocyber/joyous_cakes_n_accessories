<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'currency',
        'size_value',
        'size_unit',
        'stock',
        'sku',
        'is_active',
        'featured',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
