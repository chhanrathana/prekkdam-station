<?php

namespace App\Http\Requests\SaleMgts;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'product_id'=> 'required',
            'qty'=> 'required',
            'unit_price'=> 'required',
        ];
        return $rules;
    }
}