<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;



class CartService{


    public function getCurentUserCart(){

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

        return $transformedData;

    }


    public function addToCart(int $productId, int $quantity = 1){

        return DB::transaction(function () use ($productId, $quantity){

            $user_id = auth()->id();

            //Find or create active cart
            $cart = Cart::firstOrCreate([
                'user_id' => $user_id,
                'status' => 'active',
            ]);

            //Get product
            $product = Product::findOrFail($productId);

            if($product->stock < $quantity) throw new Exception('Not Enough stock available');

            //Add or update cart item
            CartItem::updateOrCreate(

[
                'cart_id'         => $cart->id,
                'prodcut_id'      => $product->id
            ],

    [
                'quantity'        => DB::raw("quantity + {$quantity}"),
                'price_snapshot'  => $product->price,
            ]
            );

            return $cart->load('items.product');

        });

    }

    public function updateQuantity(int $cartItemId, int $quantity){

        if($quantity < 1) throw new Exception("Quantity must be at least 1.");

        CartItem::where('cart_id', $cartItemId)
            ->update(['quantity' => $quantity]);
    }


    public function clearCart(){
        $cart = Cart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();


        if ($cart) {
            $cart->items()->delete();
        }

    }


}
