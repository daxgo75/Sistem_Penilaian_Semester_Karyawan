<?php

namespace App\Exports;

use App\Models\DataKaryawan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataKaryawanExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles
{
    protected $divisi;
    protected $semester;

    public function __construct($divisi = null, $semester = null)
    {
        $this->divisi = $divisi;
        $this->semester = $semester;
    }

    public function array(): array
    {
        $karyawans = DataKaryawan::when($this->divisi, function ($query) {
            return $query->where('divisi', $this->divisi);
        })
        ->when($this->semester, function($query){
            return $query->where('semester', $this->semester);
        })
        ->get();

        $exportData = [];
        
        foreach ($karyawans as $row) {
            $exportData[] = [
                $row->nama,
                $row->nip,
                $row->golongan,
                $row->jabatan,
                $row->unit_kerja,
                $row->divisi,
                $row->pejabat_penilai,
                $row->penilaians->nilai_managerial ?? '-',
                $row->penilaians->nilai_kinerja_1 ?? '-',
                $row->penilaians->nilai_kinerja_2 ?? '-',
                $row->penilaians->nilai_kinerja_3 ?? '-',
                $row->penilaians->nilai_kinerja_4 ?? '-',
                $row->penilaians->rata_rata_kinerja ?? '-',
                $row->penilaians->nilai_perilaku_1 ?? '-',
                $row->penilaians->nilai_perilaku_2 ?? '-',
                $row->penilaians->nilai_perilaku_3 ?? '-',
                $row->penilaians->nilai_perilaku_4 ?? '-',
                $row->penilaians->rata_rata_perilaku ?? '-',
                $row->penilaians->rata_rata_prestasi ?? '-',
            ];
        }
        return $exportData;
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'NIP',
            'GOLONGAN',
            'JABATAN',
            'UNIT KERJA',
            'DIVISI',
            'PEJABAT PENILAI',
            'KEMAMPUAN MANAJERIAL',
            'BEBAN KERJA',
            'KUALITAS KERJA',
            'PEMELIHARAAN PERALATAN',
            'HUBUNGAN ANTAR PEKERJAAN',
            'RATA-RATA KINERJA',
            'TANGGUNG JAWAB & KERJASAMA',
            'INISIATIF & KREATIVITAS',
            'TATA KRAMA & KEJUJURAN',
            'DISIPLIN',
            'RATA-RATA PERILAKU',
            'RATA-RATA PRESTASI'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 50,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 50,
            'F' => 60,
            'G' => 20,
            'H' => 30,
            'I' => 15,
            'J' => 20,
            'K' => 30,
            'L' => 35,
            'M' => 20,
            'N' => 35,
            'O' => 25,
            'P' => 30,
            'Q' => 25,
            'R' => 25,
            'S' => 25
        ];
    }

    public function styles(Worksheet $sheet)
{
    $sheet->getRowDimension(1)->setRowHeight(30);

    return [
        1 => [
            'font' => ['bold' => true, 'size' => 12],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FFFF00',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Black color
                ],
            ],
        ],
    ];
}
    
}
