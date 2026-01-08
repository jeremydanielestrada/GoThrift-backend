<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_snapshot',
    ];

    //Relationships
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
