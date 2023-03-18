<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class GroupMenu extends BaseModel
{
    protected $table = 'group_menus';

    protected $fillable = ['id', 'name'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'group_id', 'id')
        ->where('visible',1)
        ->orderBy('sort','asc');
    }
}