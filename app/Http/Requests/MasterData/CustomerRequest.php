<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'code'=> 'required|max:5',
            'name_kh'=> 'required|max:50',
            'name_en'=> 'required|max:50',
            'phone_number_01'=> 'required|max:15',
            'phone_number_02'=> 'nullable|max:15',
            'address'=> 'required',
            'sex_id'=> 'required',
        ];

        return $rules;
    }
}
