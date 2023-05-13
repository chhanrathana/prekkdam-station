<?php

namespace App\Models;

class Commune extends BaseModel
{
    protected $table = 'communes';
    
    public function villages()
    {
        return $this->hasMany(Village::class);
    }
    
    public function district() {
        return $this->belongsTo(District::class);
    }
}
