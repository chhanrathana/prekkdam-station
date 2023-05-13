<?php

namespace App\Models;

use Carbon\Carbon;

class PaymentRevenue extends BaseModel
{
    
    protected $table = 'payment_revenues';

    public function LoanPayment(){
        return $this->belongsTo(LoanPayment::class);
    }

    public function getPaymentDatetimeAttribute($value)
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
