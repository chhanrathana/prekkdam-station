<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banknote extends Model
{
    protected $table = 'banknotes';

    protected $fillable = [
        '*',        
    ];
   
}
