<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class ProductType extends BaseModel
{
    protected $table = 'product_types';   

    protected $fillable = ['id','prefix','name_kh','name_en','active','sort'];

    public function products(){ 
        return $this->hasMany(Product::class);
    }    
}