<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}


    public function index(){

      return response()->json($this->productService->getAllProducts());
    }

    public function view(string $id){

     return response()->json($this->productService->getProductById($id));

    }


    public function store(ProductRequest $request){

        $validated = $request->validated();

        return response()->json($this->productService->createProduct($validated), 201);
    }


    public function update(ProductRequest $request, string $id){

        $validated = $request->validated();

        return response()->json($this->productService->updateProduct($validated, $id), 201);
    }

    public function destroy(string $id){

        return response()->json($this->productService->deleteProduct($id), 200);
    }
}
