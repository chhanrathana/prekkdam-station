<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class InterestRate extends BaseModel
{
    protected $fillable = [
        'name',
        'rate',
        'commission_rate'
    ];
    
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort', 'asc');
        });
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
