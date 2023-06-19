<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OilPurchaseRequest extends FormRequest
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
            'qty_ton' => 'required',
            'purchase_date' => 'date_format:d/m/Y',
            'cost_usd' => 'required',
            'oil_type_id' => 'required',
        ];       
    }
}
