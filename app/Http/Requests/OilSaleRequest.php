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
            'date' => 'date_format:d/m/Y',            
            'work_shift_id' =>'required',
            'oil_purchase_id' => 'required',
            'old_motor_right' => 'required|numeric',
            'new_motor_right' => 'required|numeric|gt:old_motor_right',
            'old_motor_left' => 'required|numeric',
            'new_motor_left' => 'required|numeric|gt:old_motor_left',
            'price' => 'required|numeric',
        ];
    }
}
