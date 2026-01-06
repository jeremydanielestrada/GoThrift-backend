<?php


namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class ProductService{


    public function getAllProducts(){
        return Product::all();
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



    public function updateProduct(array $fields, Product $product){


        if(isset($fields['image']) && $fields['image'] instanceof UploadedFile){

            Storage::delete($product->image);

            $fields['image'] = $fields['image']->store('products');
        }


        $product->update($fields);
        $product->refresh();



        return[
            'message' => 'Product updated successfully',
            'product' => $product,
        ];
    }



    public function deleteProduct(Product $product){

       // checking if image exists
     if($product->image && Storage::exists($product->image)){
        Storage::delete($product->image);
     }
        $product->delete();
    }





}
