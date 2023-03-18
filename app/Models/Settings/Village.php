<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class Village extends BaseModel
{
    protected $table = 'villages';

    public function locationType(){
        return $this->belongsTo(locationType::class,'location_type_id');
    }
        
}