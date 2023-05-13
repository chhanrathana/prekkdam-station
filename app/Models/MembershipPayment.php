<?php

namespace App\Models;


class MembershipPayment extends BaseModel
{

    protected $table = 'membership_payments';

    public static function boot()
    {
        parent::boot();       
    }
   
    public function _status()
    {
        return $this->belongsTo(PaymentStatus::class, 'status');
    }

    public function membership() {
        return $this->belongsTo(Membership::class);
    }


    public function setInterestAmountAttribute($value)
    {
        // round down to 100
        $this->attributes['interest_amount'] = floor($value / 100) * 100;        
        // round($value, -2);
    }

}