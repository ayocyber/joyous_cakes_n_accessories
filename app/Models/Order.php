<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'subtotal',
        'shipping_fee',
        'total_price',
        'currency',
        'status',
        'payment_status',
        'payment_method',
        'ordered_at',
        'shipped_at',
        'delivered_at',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
