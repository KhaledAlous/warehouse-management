<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
        // return  auth()->User()-> id !=1;
    }

    public function rules()
    {
        return [
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'price' => 'required|numeric',
        //   'category_id' => 'required|exists:categories,id',
          ''
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required_name'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
    
}
/**
 * 
 */