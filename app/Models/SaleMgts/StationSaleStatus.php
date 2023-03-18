<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;

class StationSaleStatus extends BaseModel
{
    protected $table = 'station_sale_status';    

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
        'color',        
        'active',
        'sort',        
    ];

    public function station(){
        return $this->hasMany(StationSale::class);
    }
}