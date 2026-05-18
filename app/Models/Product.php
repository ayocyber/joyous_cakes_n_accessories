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
        'image_path',
        'price',
        'currency',
        'size_value',
        'size_unit',
        'stock',
        'sku',
        'is_active',
        'featured',
    ];

    protected $casts = [
        'image_path' => 'array',
        'is_active' => 'boolean',
        'featured' => 'boolean',
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
