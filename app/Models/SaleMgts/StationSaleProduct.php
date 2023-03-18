<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;
use App\Models\Settings\Product;

class StationSaleProduct extends BaseModel
{
    protected $table = 'station_sale_products';    

    protected $fillable = [
        'id',
        'qty',
        'unit_price',
        'total_price',        
        'product_id',
        'station_sale_id',       
    ];

    public function station(){
        return $this->belongsTo(StationSale::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}