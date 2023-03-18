<?php

namespace App\Models\Payments;

use App\Models\BaseModel;

class PaymentMethod extends BaseModel
{
    protected $table = 'payment_methods';    

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
    ];
}