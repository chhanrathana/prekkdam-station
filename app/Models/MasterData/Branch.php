<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class Branch extends BaseModel
{
    protected $table = 'branches';   

    protected $fillable = ['id','name_kh','name_en','active','sort'];

    
}