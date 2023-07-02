<?php

namespace App\Models;

class OilType extends BaseModel
{
    
    protected $table = 'oil_types'; 

    protected $fillable = [
        'code',
        'name_en',
        'name_kh',        
        'liter_of_ton',
        'active'        
    ];    

    public function sales(){
        return $this->hasMany(OilSale::class);
    }

    public function purchases(){
        return $this->hasMany(OilPurchase::class);
    }
}
