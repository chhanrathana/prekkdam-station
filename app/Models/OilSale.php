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
        'staff_id',
        'client_id',
        'paid_amount'
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

    public function staff()
    {
        return $this->belongsTo(Staff::class,'staff_id');
    }

    public function shift()
    {
        return $this->belongsTo(WorkShift::class,'work_shift_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
   
}