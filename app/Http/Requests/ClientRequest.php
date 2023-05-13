<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'date_of_birth' => 'required|date_format:d/m/Y',
            'phone_number' => 'required|unique:clients,phone_number,'.$this->id,
            'id_card_no' => 'required|unique:clients,id_card_no,'.$this->id,

            'province_id' => 'required',
            'district_id' => 'required',
            'commune_id' => 'required',
            'village_id' => 'required',            
        ];
    }
}
