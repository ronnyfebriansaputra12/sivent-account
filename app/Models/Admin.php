<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'nama','email','password','contact','role_id'
    ];

    function role() {
        return $this->belongsTo(Role::class, 'role_id','id');
    }
}
