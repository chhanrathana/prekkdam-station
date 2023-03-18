<?php

namespace App\Models\Apps;

use Illuminate\Support\Str;

class Role extends \Spatie\Permission\Models\Role
{    
    protected $table = "roles";
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $keyType = 'string';
    
    public static function boot(){
        parent::boot();
        # AUTO GENERATE UUID
        self::creating( function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}