<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class ShareHolderType extends BaseModel
{
    protected $table = 'shareholder_types';    

    protected $fillable = [
        'id',        
        'name_en',
        'name_kh',      
        'active',        
    ];            
}
