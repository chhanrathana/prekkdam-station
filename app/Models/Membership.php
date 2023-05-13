<?php

namespace App\Models;


class Membership extends BaseModel
{
   
    protected $fillable = [
        'code',
        'registration_date',
        'principal_amount',        
        'term',
        'start_interest_date',
        'interest_rate',
        'update_balance_date',
        'balance_amount',
        'status',
        'client_id',
        'deposit_type_id',
        'branch_id',
    ];
        
    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
    
    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function type()
    {
        return $this->belongsTo(DepositType::class,'deposit_type_id');
    }

    public function _status()
    {
        return $this->belongsTo(DepositStatus::class, 'status');
    }

    public function payments()
    {
        return $this->hasMany(DepositPayment::class)->orderByDesc('end_interest_date');
    }   
}