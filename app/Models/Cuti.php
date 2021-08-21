<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = ['cuti_in', 'cuti_out', 'cuti_verified', 'cuti_type', 'cuti_reason', 'kary_id'];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'kary_id', 'cuti_id');
    }
}
