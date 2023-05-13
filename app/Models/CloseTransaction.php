<?php

namespace App\Models;

use Carbon\Carbon;

class CloseTransaction extends BaseModel
{
    protected $table = 'closing_transactions';

    public function setTransactionDateAttribute($value)
    {
        $this->attributes['transaction_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function getTransactionDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function bankNotes(){
        return $this->hasMany(BanknoteTransaction::class, 'closing_transaction_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

}
