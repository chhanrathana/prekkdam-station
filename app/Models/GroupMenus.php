<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMenus extends Model
{
    protected $table = 'group_menus';

    public $incrementing = true;

    protected $fillable = [
        'id',
        'name'
    ];

 

    public function menus(){        
        $menu =  $this->hasMany(Menu::class,'group_id','id');
        return $menu;
    }
}
