<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;

class RetailSaleStatus extends BaseModel
{
    protected $table = 'retail_sale_status';    

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
        'color',        
        'active',
        'sort',        
    ];

    public function retail(){
        return $this->hasMany(RetailSale::class);
    }
}