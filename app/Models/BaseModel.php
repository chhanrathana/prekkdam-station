<?php

namespace App\Models;

use App\Traits\Getter;
use App\Traits\Setter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BaseModel extends Model
{
 
    public $incrementing = false;
    protected $keyType = 'string';

    use SoftDeletes;

    use Setter, Getter;

    # todo something on model boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });      

        // static::addGlobalScope('order', function (Builder $builder) {
        //     $builder->orderBy('created_at', 'asc');
        // });
    }

}