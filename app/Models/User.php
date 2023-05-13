<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'branch_id',
        'user_type_id'
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function hasMenu(){
        return $this->hasOne(UserHasMenu::class,'user_id','id');
    }

    public function branch(){
        
        return $this->belongsTo(Branch::class);
    }

    public function type(){
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function getAvatarAttribute($value){
        return $value??'/avatar/avatar.png';
    }
}