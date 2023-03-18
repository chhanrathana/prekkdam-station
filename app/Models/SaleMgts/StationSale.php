<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;
use App\Models\Payments\Payment;
use App\Models\Settings\ShareHolder;
use App\Models\Settings\Turn;

class StationSale extends BaseModel
{
    protected $table = 'station_sales';    

    protected $fillable = [
        'id',
        'code',
        'order_date',
        'total_amount',
        'paid_amount',
        'status_id',
        'active',
        'sort',
        'turn_id',
        'staff_id',
    ];

    public function products(){
        return $this->hasMany(StationSaleProduct::class);
    }

    public function turn(){
        return $this->belongsTo(Turn::class);
    }

    public function status(){
        return $this->belongsTo(StationSaleStatus::class);
    }

    public function staff(){
        return $this->belongsTo(ShareHolder::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class,'reference_number','code');
    }
}