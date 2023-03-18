<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class Sex extends BaseModel
{
    protected $table = 'sex';

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
    ];
}