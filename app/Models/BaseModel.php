<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BaseModel extends Model
{       
 
    public $incrementing = false;

    protected $keyType = 'string';

    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid();
            $model->user_id = Auth::id();
        });       
    }  
    

    public function setRegistrationDateAttribute($value)
    {
        $this->attributes['registration_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }
 

     public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

   
      public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
 
    public function getUnitAttribute($value)
    {
        return strtoupper($value);
    }

    public function getCurrencyAttribute($value)
    {
        return strtoupper($value);
    }    
}