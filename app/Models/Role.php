<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'nama_role', 'deskripsi'
    ];

    function admins()
    {
        return $this->hasMany(Admin::class);
    }

    function privilage()
    {
        return $this->hasMany(Privilage::class);
    }
}
