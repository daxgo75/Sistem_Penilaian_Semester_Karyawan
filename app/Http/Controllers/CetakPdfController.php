<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\DataKaryawan;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Session;

class CetakPdfController extends Controller
{
    public function cetakPdf($id)
    {
        $datakaryawans = DataKaryawan::findOrFail($id);
        $penilaians = Penilaian::where('datakaryawan_id', $id)->first();

        if (!$penilaians) {
            Session::flash('error', 'Maaf, cetak PDF belum bisa dilakukan. Mohon isi penilaian terlebih dahulu.');
            return redirect()->back();
        }

        $semester = $datakaryawans->semester;

        $fileName = 'Penilaian ' . str_replace(' ', ' ', strtolower($datakaryawans->nama)) . ' semester ' .  $semester . ' ' . '.pdf';

        $pdf = Pdf::loadView('pdf.cetak', compact('datakaryawans', 'penilaians'));

        return $pdf->download($fileName);
    }
}
