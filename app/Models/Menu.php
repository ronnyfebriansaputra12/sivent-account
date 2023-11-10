<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama_menu','url','group_menu_id'
    ];

    protected $tables = 'menus';

    function groupMenu() {
        return $this->belongsTo(GroupMenu::class, 'group_menu_id', 'id');
    }
}
