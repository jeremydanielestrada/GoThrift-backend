<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(private CartService $cartService) {}


    public function index(){

         return response()->json($this->cartService->getCurentUserCart(), 200);

    }


    public function add(Request $request){

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'sometimes|integer|min:1',
        ]);

        $cart = $this->cartService->addToCart($request->product_id, $request->quantity ?? 1);

        return response()->json($cart, 201);
    }

    public function update(Request $request){
        $request->validate([
             'cart_id'    => 'required|exists:cart,id',
             'quantity'   => 'sometimes|integer|min:1',
        ]);

        $this->cartService->updateQuantity($request->cart_id, $request->quantity ?? 1);

    }

    public function remove($id){

        $this->cartService->removeItem($id);

        return response()->noContent();
    }

}
