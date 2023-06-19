<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OilSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sale_date' => 'date_format:d/m/Y',            
            'work_shift_id' =>'required',
            'oil_purchase_id' => 'required',
            'old_capacitor_r' => 'required|numeric',
            'new_capacitor_r' => 'required|numeric|gt:old_capacitor_r',
            'old_capacitor_l' => 'required|numeric',
            'new_capacitor_l' => 'required|numeric|gt:old_capacitor_l',
            'sale_price_khr' => 'required|numeric',
        ];
    }
}
