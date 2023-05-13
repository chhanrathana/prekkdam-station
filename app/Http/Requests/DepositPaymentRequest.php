<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositPaymentRequest extends FormRequest
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
        // return [
        //     'name' => 'required|max:100',
        //     'rate' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
        //     'commission_rate' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/'
        // ];

        return [
            // 'status' => 'required',
            'deposit_amount' => 'required|numeric',
            'withdraw_amount' => 'required|numeric'
        ];
    }
}
