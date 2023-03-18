<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;
use App\Models\Settings\Product;

class WholesaleProduct extends BaseModel
{
    protected $table = 'wholesale_products';    

    protected $fillable = [
        'id',
        'qty',
        'unit_price',
        'total_price',        
        'product_id',
        'wholesale_id',       
    ];

    public function wholesal(){
        return $this->belongsTo(Wholesale::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}