<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'plate_number'=> 'unique:vehicles,plate_number|required|max:50',
            'volume_kg'=> 'required|numeric',            
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $id = $this->route()->parameter('vehicle');
            
            $rules['plate_number'] = [
                'nullable',
                'max:10',
                Rule::unique('vehicles')->ignore($id),
            ];           
        }


        return $rules;
    }
}
