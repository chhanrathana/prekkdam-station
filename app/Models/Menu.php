<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'id',
        'parent_id',
        'label',
        'url',
        'active_url',
        'permission',
        'icon',
        'deleted_at',
        'group_id'
    ];

    public function childs(){
        return $this->hasMany(Menu::class,'parent_id','id');
    }

    public function parent(){
        return $this->belongsTo(Menu::class,'parent_id','id');
    }

    public function group(){
        return $this->belongsTo( GroupMenus::class,'group_id','id');
    }

    public function url(){
        return $this->hasOne( URL::class,'url_id','id');
    }
}
