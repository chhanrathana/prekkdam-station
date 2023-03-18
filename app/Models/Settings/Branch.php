<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class Branch extends BaseModel
{
    protected $table = 'branches';   

    protected $fillable = ['id','name_kh','name_en','active','sort'];

    
}