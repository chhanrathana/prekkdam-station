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
        'vendor_id',
        'paid_amount',
        'tank_id'
    ];

    public static function boot()
    {
        parent::boot();      
    }

    public function type()
    {
        return $this->belongsTo(OilType::class,'oil_type_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function tank()
    {
        return $this->belongsTo(Tank::class,'tank_id');
    }

    public function _status()
    {
        return $this->belongsTo(OilStatus::class, 'status_id');
    }

    public function sales()
    {
        return $this->hasMany(OilSale::class,'oil_purchase_id');
    }
   
}