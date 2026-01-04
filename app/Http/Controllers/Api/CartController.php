<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id', auth()->id())
                    ->where('status', 'active')
                    ->with(['items.product'])
                    ->first();
         if (!$cart) {
               return response()->json(['items' => [], 'total' => 0]);
         }

         //transfrom data into API ready response
        $transformedData = [
            'items' => $cart->items->map(fn ($item) => [
                'id'         => $item->id,
                'product_id' => $item->product->id,
                'name'       => $item->product->name,
                'image'      => $item->product->image,
                'quantity'   => $item->quantity,
                'price'      => $item->price_snapshot,
                'subtotal'   => $item->quantity * $item->price_snapshot,
            ]),

            'total' => $cart->items->sum(fn ($item) =>
             $item->quantity * $item->price_snapshot),
        ];

         return response()->json($transformedData, 200);

    }

}
