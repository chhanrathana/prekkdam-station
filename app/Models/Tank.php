<?php

namespace App\Models;

class Tank extends BaseModel
{
    protected $table = 'tanks'; 

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
        'active'
    ]; 
}
