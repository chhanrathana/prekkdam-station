<?php

namespace App\Http\Requests\Dividends;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfitCenterRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules = [
            'public_level_code' => ['required'],
            'code'  => ['required', 'max:25','unique:profit_centers,code'],
            'name_kh' => ['required', 'max:255'],
            'name_en' => ['nullable', 'max:255'],
            'active' => ['required', 'max:50'],
            'province_code' => ['nullable', 'max:50'],
            'sort' => ['nullable', 'max:50'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = $this->route()->parameter('profit_center');
            
            $rules['code'] = [
                'nullable',
                'max:10',
                Rule::unique('profit_centers')->ignore($id),
            ];           
        }

        return $rules;
    }
}
