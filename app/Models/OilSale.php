<?php

namespace App\Models;

class OilSale extends BaseModel
{
    protected $table = 'oil_sales';

    protected $fillable = [
        'code',
        'sale_date',
        'old_capacitor_r',        
        'new_capacitor_r',
        'qty_liter_r',
        'old_capacitor_l',
        'new_capacitor_l',        
        'qty_liter_l',
        'total_qty_liter',
        'total_qty_ton',
        'sale_price_khr',
        'sale_price_usd',
        'total_sale_price_khr',
        'total_sale_price_usd',

        'oil_purchase_id',
        'work_shift_id',
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