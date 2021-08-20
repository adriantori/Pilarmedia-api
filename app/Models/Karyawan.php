<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = ['kary_nama', 'kary_user', 'kary_pass', 'kary_role'];

    public function absensi(){
        return $this->hasMany(Absensi::class);
    }

    public function cuti(){
        return $this->hasMany(Cuti::class);
    }
}
