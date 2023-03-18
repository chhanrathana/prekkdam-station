<?php

namespace App\Models\ProductMgts;

use App\Models\BaseModel;
use App\Models\Settings\Branch;
use App\Models\Settings\File;
use App\Models\Settings\Product;
use App\Models\Settings\ShareHolder;

class ProductOrder extends BaseModel
{
    protected $table = 'product_orders';    

    protected $fillable = [
        'id',
        'order_date',
        'qty',
        'unit_cost',
        'total_cost',
        'description',
        'status_id',
        'active',
        'sort',
        'remain_qty',
        'vehicle_id',
        'driver_id',
        'vendor_id',
        'unit_type_id',
        'product_id',
        'branch_id',
        'active',
        'sort'
    ];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function driver(){
        return $this->belongsTo(ShareHolder::class);
    }

    public function vendor(){
        return $this->belongsTo(ShareHolder::class);
    }

    public function files(){        
        return $this->belongsToMany(File::class,'product_order_files');
    }
}