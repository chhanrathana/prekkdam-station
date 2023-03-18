<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;
use App\Models\Settings\Product;

class RetailSaleProduct extends BaseModel
{
    protected $table = 'retail_sale_products';    

    protected $fillable = [
        'id',
        'qty',
        'unit_price',
        'total_price',        
        'product_id',
        'retail_sale_id',       
    ];

    public function retail(){
        return $this->belongsTo(RetailSale::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}