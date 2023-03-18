<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;
use App\Models\Payments\Payment;
use App\Models\Settings\Product;
use App\Models\Settings\ShareHolder;
use App\Models\Settings\Vehicle;

class RetailSale extends BaseModel
{
    protected $table = 'retail_sales';    

    protected $fillable = [
        'id',
        'code',
        'order_date',
        'total_amount',
        'paid_amount',
        'status_id',
        'active',
        'sort',
        'vehicle_id',
        'driver_id',
        'client_id',
    ];

    public function products(){
        return $this->hasMany(RetailSaleProduct::class);
    }

    public function driver(){
        return $this->belongsTo(ShareHolder::class);
    }

    public function status(){
        return $this->belongsTo(RetailSaleStatus::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function client(){
        return $this->belongsTo(ShareHolder::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class,'reference_number','code');
    }
}