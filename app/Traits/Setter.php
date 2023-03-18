<?php
namespace App\Traits;


use Carbon\Carbon;

trait Setter{

    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setDateOfBirthAttribute($value)
    {        
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setOrderDateAttribute($value)
    {        
        $this->attributes['order_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setPaymentDatetimeAttribute($value)
    {        
        $this->attributes['payment_datetime'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }
 
    public function setEndWorkingDateAttribute($value)
    {        
        $this->attributes['end_working_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setStartDateAttribute($value)
    {        
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setPrintDateAttribute($value)
    {        
        $this->attributes['print_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setExpDateAttribute($value)
    {        
        $this->attributes['exp_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setExpAdvisorCardAttribute($value)
    {        
        $this->attributes['exp_advisor_card'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setCloseDateAttribute($value)
    {        
        $this->attributes['close_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = mb_strtoupper($value);
    }

    public function setNameKhAttribute($value)
    {
        $this->attributes['name_kh'] = mb_strtoupper($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function setIdentityAttribute($value)
    {
        $this->attributes['identity'] = strtoupper($value);
    }

    public function setRequestDateAttribute($value)
    {
        $this->attributes['request_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setStudyDateAttribute($value)
    {
        $this->attributes['study_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setGraduateDateAttribute($value)
    {
        $this->attributes['graduate_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setWorkedAtAttribute($value)
    {
        $this->attributes['worked_at'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setEndWorkedAtAttribute($value)
    {
        $this->attributes['end_worked_at'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setLeaveDateAttribute($value)
    {
        $this->attributes['leave_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setReturnDateAttribute($value)
    {
        $this->attributes['return_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }
   
    public function setStartWorkingDateAttribute($value)
    {
        $this->attributes['start_working_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }

    public function setAppointedDateAttribute($value)
    {
        $this->attributes['appointed_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }  

    public function setUpgradeSalaryRankDateAttribute($value)
    {
        $this->attributes['upgrade_salary_rank_date'] = $value ? Carbon::parse(str_replace('/', '-', $value)) : null;
    }
}