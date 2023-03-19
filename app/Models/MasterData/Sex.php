<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class Sex extends BaseModel
{
    protected $table = 'sex_id';

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
    ];
}