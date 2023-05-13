<?php

namespace App\Models;

use Carbon\Carbon;

class Calendar extends BaseModel
{
    protected $table = 'calendars';


    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
