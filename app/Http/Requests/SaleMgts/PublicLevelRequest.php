<?php

namespace App\Http\Requests\Dividends;

use Illuminate\Foundation\Http\FormRequest;

class PublicLevelRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'code'  => ['required'],
            'name_kh' => ['required', 'max:255'],
            'name_en' => ['required', 'max:255'],
            'type_kh' => ['required', 'max:255'],
            'type_en' => ['required', 'max:255'],
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
