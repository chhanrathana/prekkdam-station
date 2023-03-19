<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductOrderRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        
        $step = $this->route()->parameter('step');
        
        $rules = [];
        if($step == 1){
            $rules = [
                'product_id'=> 'required',
                'order_date'=> 'required',
                'qty'=> 'required',
                'unit_cost'=> 'required',
                'branch_id'=> 'required',
                'driver_id'=> 'required',
                'vehicle_id'=> 'required',     
                'vendor_id'=> 'required',            
            ];                       
        }elseif($step == 2){

        }
        
        return $rules;
    }
}
