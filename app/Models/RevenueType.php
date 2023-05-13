<?php

namespace App\Models;

use Carbon\Carbon;

class RevenueType extends BaseModel
{
   
    protected $fillable = [
        'name_kh',
        'name_en'
    ];      

    public function getExpenseDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getExpenseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}