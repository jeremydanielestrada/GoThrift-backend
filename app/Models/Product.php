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

    public function cartItem(){

        return $this->hasMany(CartItem::class, 'product_id');
    }
}
