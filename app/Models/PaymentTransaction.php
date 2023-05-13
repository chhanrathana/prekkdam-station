<?php

namespace App\Models;

use Carbon\Carbon;

class PaymentTransaction extends BaseModel
{
    
    protected $table = 'payment_transactions';

    public function LoanPayment(){
        return $this->belongsTo(LoanPayment::class);
    }

    public function getTransactionDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getTransactionDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
