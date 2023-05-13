<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        });       
    }  

    public function setRegistrationDateAttribute($value)
    {
        $this->attributes['registration_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setStartInterestDateAttribute($value)
    {
        $this->attributes['start_interest_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }
    
    public function setEndInterestDateAttribute($value)
    {
        $this->attributes['end_interest_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

     public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setInterestAmountAttribute($value)
    {
        $this->attributes['interest_amount'] = round($value, -2);
    }
    
    public function getRegistrationDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getUpdateBalanceDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

      public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getTransactionDatetimeAttribute($value)
    {
        return $value?Carbon::parse($value)->format('d/m/Y H:i:s'):null;
    }

    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getEndInterestDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function getStartInterestDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
}