<?php

namespace App\Models;

class DepositType extends BaseModel
{   
    protected $table = 'deposit_types'; 

     protected $fillable = [
        'name_kh',
        'name_en'
    ]; 
}