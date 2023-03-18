<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class Product extends BaseModel
{
    protected $table = 'products';   

    protected $fillable = ['id','code','name_kh','name_en','unit_kh','unit_en','active','sort', 'product_type_id', 'description' , 'avatar'];

    public function productType(){
        return $this->belongsTo(ProductType::class);
    }

    public function saleTypes(){        
        return $this->belongsToMany(SaleType::class,'sale_type_products','product_id','sale_type_id');
    }
}