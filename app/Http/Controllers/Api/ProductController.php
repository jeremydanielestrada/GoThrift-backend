<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}


    public function index(){

      return response()->json($this->productService->getAllProducts());
    }

    public function show(string $id){

     return response()->json($this->productService->getProductById($id));

    }


    public function store(ProductRequest $request){

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        return response()->json($this->productService->createProduct($validated), 201);
    }


    public function update(ProductRequest $request, Product $product ){


        $validated = $request->validated();

        return response()->json($this->productService->updateProduct($validated, $product), 200);
    }

    public function destroy($id){
        $this->productService->deleteProduct($id);

        return response()->noContent();
    }
}
