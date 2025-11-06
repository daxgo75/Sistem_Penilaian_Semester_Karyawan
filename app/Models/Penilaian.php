<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaians';
    protected $fillable = [
        'datakaryawan_id',
        'nilai_managerial',
        'nilai_kinerja_1',
        'nilai_kinerja_2',
        'nilai_kinerja_3',
        'nilai_kinerja_4',
        'rata_rata_kinerja',
        'nilai_perilaku_1',
        'nilai_perilaku_2',
        'nilai_perilaku_3',
        'nilai_perilaku_4',
        'rata_rata_perilaku',
        'rata_rata_prestasi',
    ];

    // Aksesors untuk menghitung rata-rata prestasi
    public function getRataRataPrestasiAttribute()
{
    if (is_null($this->nilai_managerial)) {
        $rataRata = ($this->rata_rata_kinerja + $this->rata_rata_perilaku) / 2;
    } else {
        $rataRata = ($this->nilai_managerial + $this->rata_rata_kinerja + $this->rata_rata_perilaku) / 3;
    }

    return round($rataRata, 2); // Menjadikan 2 angka desimal
}


    public function DataKaryawan()
    {
        return $this->belongsTo(DataKaryawan::class, 'datakaryawan_id');
    }
}