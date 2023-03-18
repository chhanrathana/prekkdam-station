<?php

namespace App\Models\Payments;

use App\Models\BaseModel;

class Payment extends BaseModel
{
    protected $table = 'payments';    

    protected $fillable = [
        'id',
        'reference_number',
        'paid_amount',
        'payment_datetime',
        'remark',
        'payment_method_id'
    ];

    public function method(){
        return $this->belongsTo(PaymentMethod::class,'payment_method_id','id');
    }
}