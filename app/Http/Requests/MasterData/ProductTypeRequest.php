<?php
namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'code' => ['required', 'max:1'],
            'name_kh' => ['required', 'max:200'],
            'name_en' => ['required', 'max:200'],
            // 'active' => ['required', 'boolean'],            
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
