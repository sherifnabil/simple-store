<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'  =>  [
                'required',
                'string'
            ],
            'active' =>  [
                'required',
                'int',
                'in:0,1',
            ],
            'stock' =>  [
                'required',
                'numeric',
                'min:1'
            ],
            'price' =>  [
                'required',
                'numeric',
                'min:1'
            ],
            'categories' =>  [
                'required',
                'array',
            ],
            'categories.*' =>  [
                'required',
                'exists:categories,id'
            ],
        ];
    }
}
