<?php

namespace App\Models;

class Village extends BaseModel
{
    protected $table = 'villages';
    
    public function commune() {
        return $this->belongsTo(Commune::class);
    }
}
