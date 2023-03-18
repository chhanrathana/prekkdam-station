<?php

namespace App\Models\SaleMgts;

use App\Models\BaseModel;

class WholesaleStatus extends BaseModel
{
    protected $table = 'wholesale_status';    

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
        'color',        
        'active',
        'sort',        
    ];

    public function wholesales(){
        return $this->hasMany(Wholesale::class);
    }

}