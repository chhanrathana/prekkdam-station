<?php

namespace App\Models;


class Shareholder extends BaseModel
{

    protected $fillable = [
        'name_kh',
        'name_en',
        'earn_rate',        
    ];

    public function deposit(){
        return $this->hasOne(Deposit::class, 'shareholder_id');
    }
    
}