<?php

namespace App\Models;

class Province extends BaseModel
{
    protected $table = 'provinces';
    
    public function districts() {
        return $this->hasMany(District::class);
    }
}
