<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Vendor extends BaseModel
{
    
    protected $fillable = [
        'name_en',
        'name_kh',
        'sex',
        'date_of_birth',
        'phone_number',
        'village_id',
        'code',
        'status',
        'user_id',
        'id_card_no',
        'photo',
        'client_type_id'
    ];

    public static function boot()
    {
        parent::boot(); 
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function village() {
        return $this->belongsTo(Village::class);
    }

    public function type() {
        return $this->belongsTo(ClientType::class, 'client_type_id');
    }

    public function loans(){
        return $this->hasMany(Loan::class);
    }


    public function memberships(){
        return $this->hasMany(Memberships::class);
    }

    public function newLoans(){
        return $this->hasMany(Loan::class)->where('client_id' ,'>', 1);
    }

    public function isHasActiveLoan(){
        return $this->loans()->where('status','!=','finish')->count();
    }

    public function getAddressAttribute()
    {
        $village = Village::where('id', $this->village_id)->first();
        if(!$village){
            return '';
        }
        return
            'ភ.' . $village->name_kh
            . ' ឃ.' . $village->commune->name_kh
            . ' ស.' . $village->commune->district->name_kh;
    }

    public function _sex()
    {
        return $this->belongsTo(Sex::class, 'sex', 'id');
    }
}
