<?php

namespace App\Http\Requests\SaleMgts;
;
use Illuminate\Foundation\Http\FormRequest;

class StationSaleRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules = [
            'staff_id'=> 'required',
            'order_date'=> 'required',
            'turn_id'=> 'required',
        ];         
        return $rules;
    }
}
