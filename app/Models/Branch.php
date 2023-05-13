<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Branch extends BaseModel
{
   
    protected $fillable = [
        'code',
        'name',
        'description',        
    ];    

    public static function boot()
    {
        parent::boot();                 
    }  
}