<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class Vehicle extends BaseModel
{
    protected $table = 'vehicles';   

    protected $fillable = [
        'id',
        'plate_number',
        'volume_kg',       
    ];
}