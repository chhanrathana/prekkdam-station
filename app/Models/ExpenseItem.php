<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ExpenseItem extends BaseModel
{
   
    protected $fillable = [
        'branch_id',
        'expense_type_id',
        'amount',
        'description',
        'date'
    ];      

    public static function boot()
    {
        parent::boot();
                           
    }

    public function getExpenseDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getExpenseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function type()
    {
        return $this->belongsTo(ExpenseType::class,'expense_type_id');
    }

}