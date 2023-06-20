<?php

namespace App\Models;

class OilSale extends BaseModel
{
    protected $table = 'oil_sales';

    protected $fillable = [
        'code',
        'date',
        'old_motor_right',        
        'new_motor_right',
        'old_motor_left',
        'new_motor_left',
        'price',
        'oil_purchase_id',
        'work_shift_id',
    ];
  
    public static function boot()
    {
        parent::boot();      
    }

    public function purchase()
    {
        return $this->belongsTo(OilPurchase::class,'oil_purchase_id');
    }

    public function _status()
    {
        return $this->belongsTo(OilStatus::class, 'status_id');
    }
   
}