<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeductionPaymentRequest extends FormRequest
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
            // 'finish_end_interest_date' => 'required',
            'finish_discount' => 'numeric|min:0|max:100'
        ];
    }
}
