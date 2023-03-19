<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class LocationType extends BaseModel
{
    protected $table = 'location_types';

    protected $fillable = [
        'id',
        'name',        
    ];
}