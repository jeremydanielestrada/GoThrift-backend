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

    public function destroy(string $id){

        $this->cartService->deleteCurrentUserCart($id);

        return response()->json(null, 204);
    }

}
