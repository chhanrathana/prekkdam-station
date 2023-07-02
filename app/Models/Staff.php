<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Staff extends BaseModel
{

    protected $table = 'staffs';
    
    public static function boot()
    {
        parent::boot();          
    }

    protected $fillable = [
        'name_en',
        'name_kh',
        'sex',
        'date_of_birth',
        'phone_number',
        'start_work_date',
        'status',
        'branch_id',
        'salary_amount',
        'code',
        'address'
    ];

    public function setDateOfBirthAttribute($value){
        $this->attributes['date_of_birth'] =  Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setStartWorkDateAttribute($value)
    {
        $this->attributes['start_work_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getStartWorkDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function _sex()
    {
        return $this->belongsTo(Sex::class, 'sex', 'id');
    }

    public function _status()
    {
        return $this->belongsTo(StaffStatus::class, 'status', 'id');
    }

    public function _loans($fromDate, $toDate ){
        return $this->hasMany(Loan::class,'staff_id','id')
            ->where('registration_date','>=' , $fromDate)
            ->where('registration_date','<=', $toDate);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class)->with('client','payments');
    }

    public function payments()
    {
        return $this->hasManyThrough(LoanPayment::class, Loan::class);
    }

    public function countPaymentLate()
    {
        return $this->hasManyThrough(LoanPayment::class, Loan::class)->where('payments.status', 'late')->distinct('loan_id')->count('loan_id');
    }

    public function sumPaymentLate()
    {
        $total =  $this->hasManyThrough(LoanPayment::class, Loan::class)->where('payments.status', 'late')->sum('total_amount');
        $paid =  $this->hasManyThrough(LoanPayment::class, Loan::class)->where('payments.status', 'late')->sum('total_paid_amount');
        return $total - $paid; 
    }

    public function sumPendingAmount()
    {
        return $this->hasManyThrough(LoanPayment::class, Loan::class)
        ->where('payments.status','<>', 'paid')
        ->where('payments.status','<>' ,'finish')
        ->sum('deduct_amount');
    }

    public function coutNewClient()
    {
        return $this->hasMany(Loan::class)->with('client','payments');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}