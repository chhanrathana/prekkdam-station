<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'product_type_id'=> 'required',
            'code'=> 'required|max:5',
            'name_kh'=> 'required|max:50',
            'name_en'=> 'required|max:50',
            'unit_id'=> 'required',
            'price'=> 'required|numeric',
            'cost'=> 'required|numeric',            
        ];
        
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = $this->route()->parameter('id');            
            $rules['code'] = [
                'nullable',
                'max:10',
                Rule::unique('products')->ignore($id),
            ];           
        }

        return $rules;
    }
}
