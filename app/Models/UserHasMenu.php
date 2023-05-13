<?php

namespace App\Models;

class UserHasMenu extends BaseModel
{
    protected $table = 'user_has_menu';
    
    protected $fillable = [
        'user_id',
        'menu_id',
        'created_by',
        'updated_by'
    ];

    public function menus(){
        return $this->hasMany(Menu::class,'id','menu_id');
    }

    public function menu(){
        return $this->hasOne(Menu::class,'id','menu_id');
    }
}