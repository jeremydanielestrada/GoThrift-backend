<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{

    public function __construct(private CartService $cartService) {}


    public function index(){

         return response()->json($this->cartService->getCurentUserCart(), 200);

    }


    public function add(Request $request, $product_id){

        $request->validate([
            'quantity'   => 'sometimes|integer|min:1',
        ]);

        if(!Product::find($product_id)){
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $cart = $this->cartService->addToCart($product_id, $request->quantity ?? 1);

        return response()->json($cart, 201);
    }

    public function update(Request $request){
        $request->validate([
             'cart_id'    => 'required|exists:carts,id',
             'quantity'   => 'sometimes|integer|min:1',
        ]);

        $this->cartService->updateQuantity($request->cart_id, $request->quantity ?? 1);

    }

    public function remove($id){

        $this->cartService->removeItem($id);

        return response()->noContent();
    }

}
