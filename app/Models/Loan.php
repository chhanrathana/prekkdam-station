<?php

namespace App\Models;


class Loan extends BaseModel
{
    protected $table = 'loans';

    protected $fillable = [
        'code',
        'registration_date',
        'principal_amount',        
        'term',
        'start_interest_date',
        'interest_rate',
        'update_balance_date',
        'balance_amount',        
        'staff_id',
        'loan_type_id',
        'admin_fee_amount'
    ];

    public static function boot()
    {
        parent::boot();
      
    }

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
  
    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function type()
    {
        return $this->belongsTo(LoanType::class,'loan_type_id');
    }

    public function _status()
    {
        return $this->belongsTo(LoanStatus::class, 'status');
    }

    public function payments()
    {
        return $this->hasMany(LoanPayment::class)->orderBy('end_interest_date');
    }

}