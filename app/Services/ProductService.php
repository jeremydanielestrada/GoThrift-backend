<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;



class ProductService{


    public function getAllProducts(){
        return Product::all();
    }


    public function getProductById($id){
        return Product::find($id);
    }



    public function createProduct(array $fields){

        if(isset($fields['image']) && $fields['image'] instanceof UploadedFile){
             $fields['image'] = $fields['image']->store('products');
        }

        $product = Product::create($fields);

        return[
            'message' => 'Product created successfully',
            'product' => $product,
        ];
    }



    public function updateProduct(array $fields, int $id){
        $product = Product::findOrFail($id);


        if(isset($fields['image']) && $fields['image'] instanceof UploadedFile){

            Storage::delete($product->image);

            $fields['image'] = $fields['image']->store('products');
        }else{
            unset($fields['image']);
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
