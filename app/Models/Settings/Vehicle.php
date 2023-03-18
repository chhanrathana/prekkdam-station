<?php

namespace App\Models\Settings;

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