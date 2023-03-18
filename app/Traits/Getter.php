<?php
namespace App\Traits;

use Carbon\Carbon;

trait Getter{

    public function getReleaseDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    } 
     

    public function getFileOriginalAttribute(){
        return $this->getOriginal('file')?$this->getOriginal('file'):'https://file.mpwt.gov.kh/v2/public/uploads/MPWT_HR//20210518/60a393bde5356.png';        
    }

    public function getFileAttribute(){
        return 'storage/'.$this->getOriginal('file');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getPaymentDatetimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getOrderDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getMPWTTransactionDatetimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i:s') : '';
    }
    
    public function getPrintDateAttribute($value)
    {        
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getExpDateAttribute($value)
    {        
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getExpAdvisorCardAttribute($value)
    {        
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getCloseDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getRequestDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getEndWorkingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getStudyDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getGraduateDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }
    public function getWorkedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getEndWorkedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getLeaveDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    public function getReturnDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }
    public function getStartWorkingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }
    public function getAppointedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }
    public function getUpgradeSalaryRankDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : '';
    }

    // public function getQTYAttribute($value){
    //     return number_format($value??0) .' '.($this->product->unit_kh??'');
    // }

    // public function getUnitPriceAttribute($value){
    //     return number_format($value??0).' KHR';
    // }

    // public function getTotalPriceAttribute($value){
    //     return number_format($value??0) .' KHR';
    // }
    
}
