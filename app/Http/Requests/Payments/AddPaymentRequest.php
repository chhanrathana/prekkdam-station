<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class AddPaymentRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        $rules = [
            'reference_number'=> 'required',
            'paid_amount'=> 'required',
            'payment_datetime'=> 'required',
            'remark'=> 'nullable',
        ];
        return $rules;       
    }
}