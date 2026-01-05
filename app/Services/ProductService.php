<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;



class ProductService{


    public function getAllProducts(){
        return Product::all();
    }


    public function getProductById($id){
        return Product::find($id);
    }



    public function createProduct(array $fields){

        if(isset($fields['image']) && $fields['image']){
            $fields['image'] = Storage::put('products', $fields['image']);
        }

        $product = Product::create($fields);


        return[
            'message' => 'Product created successfully',
            'product' => $product,
        ];
    }



    public function updateProduct(array $fields, int $id){
        $product = Product::findOrFail($id);


        if(isset($fields['image']) && $fields['image']){

            if($product->image) Storage::delete($product->image);

             $fields['image'] = Storage::put('products', $fields['image']);
        }

        $product = Product::update($fields);


        return[
            'message' => 'Product updated successfully',
            'product' => $product,
        ];
    }



    public function deleteProduct(int $id){

        $product = Product::find($id);

        $product->delete();
    }





}
