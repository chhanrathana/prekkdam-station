<?php

namespace App\Http\Requests\Dividends;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PublicServiceDividendRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'public_service_code'  => ['required'],
            'indicator_code' => ['required'],
            'amount' => ['required', 'numeric'],
            'percentage' => ['nullable', 'numeric'],
            'active' => ['required', 'max:50'],
            'sort' => ['nullable', 'max:50'],
        ];
        
        // if (in_array($this->method(), ['PUT', 'PATCH'])) {
        //     $id = $this->route()->parameter('indicator');
            
        //     $rules['code'] = [
        //         'nullable',
        //         'max:10',
        //         Rule::unique('indicators')->ignore($id),
        //     ];           
        // }

        return $rules;
    }
}
