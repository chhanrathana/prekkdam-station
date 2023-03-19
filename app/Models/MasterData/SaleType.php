<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class SaleType extends BaseModel
{
    protected $table = 'sale_types';

    protected $fillable = [
        'id',
        'code',
        'name_kh',
        'name_en',
    ];
}