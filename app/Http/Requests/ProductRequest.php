<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;



class ProductRequest extends FormRequest

{

    public function rules()

    {

        return [
            'name' => 'required',
            'details' => 'required',
            'price' => 'required',
            'count' => 'required',
        ];

    }
 


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'details.required' => 'details is required',
            'price.required' => 'price is required',
            'count.required' => 'count is required',
        ];

    }

}