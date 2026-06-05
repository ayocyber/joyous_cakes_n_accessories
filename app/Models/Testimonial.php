<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'location',
        'testimonial',
        'rating',
        'avatar_letter',
        'is_active',
        'sort_order',
    ];
}
