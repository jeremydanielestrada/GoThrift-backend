<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if(request()->routeIs('products.store')){
            return [
                'name'         =>'required|string|max:255',
                'description'  =>'required|string|max:255',
                'price'        =>'required|numeric|min:0',
                'stock'        =>'required|integer|min:0',
                'image'        =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'       =>'required|string|max:255',
            ];
        }else if(request()->routeIs('update')){
            return [
                'name'         =>'sometimes|required|string|max:255',
                'description'  =>'sometimes|required|string|max:255',
                'price'        =>'sometimes|required|numeric|min:0',
                'stock'        =>'sometimes|required|integer|min:0',
                'image'        =>'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'       =>'sometimes|required|string|max:255',
            ];
        }
        return [];
    }
}
