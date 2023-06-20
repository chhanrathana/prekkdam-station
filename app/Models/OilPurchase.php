<?php

namespace App\Models;

class OilPurchase extends BaseModel
{
    protected $table = 'oil_purchases';

    protected $fillable = [
        'code',
        'date',
        'qty', 
        'cost',
        'oil_type_id',        
        'status_id',
    ];

    public static function boot()
    {
        parent::boot();      
    }

    public function type()
    {
        return $this->belongsTo(OilType::class,'oil_type_id');
    }

    public function _status()
    {
        return $this->belongsTo(OilStatus::class, 'status_id');
    }
   
}