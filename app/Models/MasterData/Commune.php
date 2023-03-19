<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class Commune extends BaseModel
{
    protected $table = 'communes';    

    public function locationType(){
        return $this->belongsTo(locationType::class,'location_type_id');
    }
}