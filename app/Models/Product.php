<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'image',
        'stock',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartItems(){

        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function OrderItems(){
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
