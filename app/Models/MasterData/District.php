<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class District extends BaseModel
{
    protected $table = 'districts';

    public function locationType(){
        return $this->belongsTo(locationType::class,'location_type_id');
    }
}