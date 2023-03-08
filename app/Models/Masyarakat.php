<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'masyarakats';

    protected $fillable = [
        'email', 'password', 'nik', 'name', 'username', 'jk', 'no_hp', 'alamat', 'tgl_join', 'update_by', 'update_date'
    ];
}
