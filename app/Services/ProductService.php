<?php


namespace App\Services;

use App\Models\Product;



class ProductService{


    public function getAllProducts(){
        return Product::all();
    }


    public function getProductById($id){
        return Product::find($id);
    }



    public function createProduct(array $fields){

        $product = Product::create($fields);


        return[
            'message' => 'Product created successfully',
            'product' => $product,
        ];
    }



    public function updateProduct(array $fields, string $id){

        $product = Product::findOrFail($id);

        $product = Product::update($fields);


        return[
            'message' => 'Product updated successfully',
            'product' => $product,
        ];
    }



    public function deleteProduct(string $id){

        $product = Product::find($id);

        $product->delete();
    }





}
