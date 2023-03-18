<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class Province extends BaseModel
{
    protected $table = 'provinces';

    protected $fillable = [
        'code',
        'name_kh',
        'name_en',
    ];

    public function locationType(){
        return $this->belongsTo(locationType::class,'location_type_id');
    }

}