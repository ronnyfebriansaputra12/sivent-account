<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $fillable = [
        'nama_pengunjung','email','username_pengunjung','password','contact_pengunjung','role_id'
    ];
}
