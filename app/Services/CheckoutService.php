<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
class CheckoutService{

public function checkoutOrder(Cart $cart){

    $checkout = DB::transaction(function () use ($cart) {
        $order = Order::create([
            'user_id'      => $cart->user_id,
            'status'       => 'pending',
            'total_amount' => $cart->items->sum(fn ($item) =>
             $item->quantity * $item->price_snapshot),
        ]);

        foreach($cart->items as $items){
            OrderItem::create([
                'order_id'       => $order->id,
                'product_id'     => $items->product_id,
                'quantity'       => $items->quantity,
                'price_snapshot' => $items->price_snapshot,
            ]);
        }
    });

    return $checkout;

}

}
