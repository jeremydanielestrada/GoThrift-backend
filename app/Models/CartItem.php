<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price_snapshot',
    ];

     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }



    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }


}
