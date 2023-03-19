<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class Vendor extends BaseModel
{
    protected $table = 'vendors';    

    protected $fillable = [
        'id',
        'code',
        'is_company',
        'name_en',
        'name_kh',
        'date_of_birth',
        'phone_number_01',
        'phone_number_02',
        'active',
        'sort',
        'shareholder_type_id',
        'home_number',
        'street_number',
        'address',
        'province_id',
        'district_id',
        'commune_id',
        'village_id',
        'sex_id',
    ];      
    
    public function _sex(){
        return $this->belongsTo(Sex::class,'sex_id','id');
    }
    
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

    public function village(){
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
    
    public function getFullAddressAttribute(){
        $address = '';
        if ($this->home_number){
            $address .= 'ផ្ទះលេខ ' .($this->home_number??'').' ';
        }

        if ($this->street_number){
            $address .= 'ផ្លូវលេខ' .($this->street_number??'').' ';
        }
        $address .= ' '.($this->village->locationType->name_kh??'').($this->village->name_kh??'');
        $address .= ' '.($this->commune->locationType->name_kh??'').($this->commune->name_kh??'');
        $address .= ' '.($this->district->locationType->name_kh??'').($this->district->name_kh??'');
        $address .= ' '.($this->province->locationType->nname_khame??'').($this->province->name_kh??'');                

        return $address;
    }
}
