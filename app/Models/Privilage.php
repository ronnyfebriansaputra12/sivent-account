<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilage extends Model
{
    protected $fillable = [
        'role_id','menu_id','view','add','edit','delete','other'
    ];

    function role() {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    function menu(){
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
}
