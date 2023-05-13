<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'client_id' => 'required',
            
            // 'staff_id' => 'required',
            'registration_date' => 'date_format:d/m/Y',
            'principal_amount' => 'required',
            'start_end_interest_date' => 'date_format:d/m/Y|after:registration_date',
            'term' => 'required',
            'loan_type_id' => 'required',            
        ];
    }
}
