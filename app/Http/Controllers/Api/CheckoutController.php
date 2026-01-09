<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CheckoutService;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function __construct(private CheckoutService $checkoutService){}
    public function checkOut(Request $request, Cart $cart){
        $order = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'status'       => 'required|string|max:255',
            'total_amount' => 'required|numeric|mix:0',
        ]);

        $order_items = $request->validate([
            'order_id'       => 'required|exists:orders,id',
            'product_id'     => 'required|exists:product,id',
            'quantity'       => 'required|integer|min:0',
            'price_snapshot' => 'required|numeric|min:0'
        ]);

      $checkout_order =  $this->checkoutService->checkoutOrder($cart, $order, $order_items);
        return response()->json([
            'orders' => $checkout_order,
            'message' => 'Order Successfully,'
        ],201);
    }
}
