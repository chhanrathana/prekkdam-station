<?php

namespace App\Http\Requests\SaleMgts;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WholesaleRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules = [
            'client_id'=> 'required',
            'order_date'=> 'required',
            'driver_id'=> 'required',                                
            'vehicle_id'=> 'required',                
        ];         
        return $rules;
    }
}
