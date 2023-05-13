<?php

namespace App\Models;

class LoanType extends BaseModel
{
    protected $table = 'loan_types'; 

    protected $fillable = [
        'name_kh',
        'name_en'
    ]; 
}
