<?php

namespace App\Models;

class District extends BaseModel
{
    protected $table = 'districts';
    
    public function communes()
    {
        return $this->hasMany(Commune::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
