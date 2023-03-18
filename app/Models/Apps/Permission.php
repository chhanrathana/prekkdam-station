<?php

namespace App\Models\Apps;
use Illuminate\Support\Str;
class Permission extends \Spatie\Permission\Models\Permission
{
    
    protected $table = "app_permissions";
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