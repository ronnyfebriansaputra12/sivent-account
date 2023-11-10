<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMenu extends Model
{
    protected $fillable = [
        'nama_group_menu','deskripsi'
    ];

    protected $tables = 'group_menus';

    function menu() {
        return $this->hasMany(Menu::class);
    }

}
