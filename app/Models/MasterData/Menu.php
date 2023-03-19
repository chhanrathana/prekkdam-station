<?php

namespace App\Models\MasterData;

use App\Models\BaseModel;

class Menu extends BaseModel
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
        'group_id'
    ];

    public function childs(){
        $data = [];
        // foreach (auth()->user()->getAllPermissions() as $item ){
        //    $data [] = explode(":",$item->name)[1];
        // }
        $data = array_unique($data);
        return $this->hasMany(Menu::class,'parent_id','id')
        ->where('visible',1)
        // ->whereIn('permission',$data)
        ->orderBy('sort');
    }

    public function parent(){
        return $this ->belongsTo(Menu::class,'parent_id','id');
    }

    public function group(){
        return $this ->belongsTo( GroupMenus::class,'group_id','id');
    }
}
