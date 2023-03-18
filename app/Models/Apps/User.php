<?php

namespace App\Models\Apps;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // use HasRoles;

    protected $table = "users";
    protected $primaryKey = "id";
    public $incrementing = false;
    protected $keyType = 'string';

    // TODO SOMETHING ON BOOT
    public static function boot(){
        parent::boot();
        # AUTO GENERATE UUID
        self::creating( function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','code','avatar_id','phone','password_expire_at',
        'is_can_reset_password','reset_password_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

       /**
     * @return string
     */
    public function getRole(){
        for ($i = 0 ; $i < count($array = $this->getRoleNames()) ; $i++){
            return mb_strtoupper(str_replace(config('permission.prefix.system'),'',$array[$i]));
        }
        return null;
    }
   
}