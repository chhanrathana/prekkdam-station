<?php

namespace App\Models;



class LoanPayment extends BaseModel
{

    protected $table = 'loan_payments';

    public static function boot()
    {
        parent::boot();
    }
    
    public function _status()
    {
        return $this->belongsTo(PaymentStatus::class, 'status');
    }

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function setDeductAmountAttribute($value){
        $this->attributes['deduct_amount'] = ceil($value / 100) * 100;
    }

    public function setInterestAmountAttribute($value)
    {
        $this->attributes['interest_amount'] = ceil($value / 100) * 100;
    }
      
}