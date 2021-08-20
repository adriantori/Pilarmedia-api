<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['absen_in', 'absen_out', 'kary_id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'kary_id', 'absen_id');
    }
}
