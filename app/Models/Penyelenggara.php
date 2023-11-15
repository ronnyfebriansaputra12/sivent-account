<?php

namespace App\Models;

use App\Events\Event;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    protected $fillable = [
        'nama_penyelenggara', 'email', 'username_penyelenggara', 'password', 'contact_penyelenggara','role_id'
    ];

    function event()
    {
        return $this->hasMany(Event::class);
    }

    function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }
}
