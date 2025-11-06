<?php

namespace App\Imports;

use App\Models\DataKaryawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataKaryawanImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */

     protected $semester;

     public function __construct($semester)
     {
        $this->semester = $semester;
     }

    public function model(array $row)
    {
        return new DataKaryawan([
            'no' => $row['no'],
            'nama' => $row['nama'],
            'nip' => $row['nip'],
            'golongan' => $row['golongan'],
            'jabatan' => $row['jabatan'],
            'unit_kerja' => $row['unit_kerja'],
            'divisi' => $row['divisi'],
            'pejabat_penilai' => $row['pejabat_penilai'],
            'semester' => $this->semester,
            'General_Manager' => $row['general_manager'],
        ]);
    }
}
