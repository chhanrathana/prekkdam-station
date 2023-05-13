<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'name_kh' => 'required',
            'name_en' => 'required',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',

            'province_id' => 'required',
            'district_id' => 'required',
            'commune_id' => 'required',
            'village_id' => 'required',

            'loan_type_id' => 'required',
            'interest_rate_id' => 'required',
            'registration_date' => 'date_format:d/m/Y',
            'principal_amount' => 'required',
            'start_end_interest_date' => 'date_format:d/m/Y|after:registration_date',
            'term' => 'required',
            'branch_id' => 'required',
        ];
    }
}
