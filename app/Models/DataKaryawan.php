<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    use HasFactory;
    protected $table = 'datakaryawans';
    protected $fillable = [
        'nama',
        'nip',
        'golongan',
        'jabatan',
        'unit_kerja',
        'divisi',
        'pejabat_penilai',
        'status',
        'semester',
        'General_Manager'
    ];

    public function penilaians()
    {
        return $this->hasOne(Penilaian::class, 'datakaryawan_id');
    }
}
