<?php

namespace App\Http\Controllers;

use App\Exports\DataKaryawanExport;
use App\Models\DataKaryawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = DataKaryawan::orderBy('id', 'asc');

        if ($request->filled('filter_divisi')) {
            $query->where('divisi', $request->filter_divisi);
        }
        $request->session()->put('filter_divisi', $request->filter_divisi);

        if ($request->filled('filter_semester')) {
            $query->where('semester', $request->filter_semester);
        }
        $request->session()->put('filter_semester', $request->filter_semester);

        $datakaryawans = $query->paginate(10)->appends([
            'filter_divisi' => $request->filter_divisi,
            'filter_semester' => $request->filter_semester
        ]);

        $allDivisions = DataKaryawan::select('divisi')->distinct()->get();
        $allSemesters = DataKaryawan::select('semester')->distinct()->get();

        return view('laporan.riwayat', compact('datakaryawans', 'allDivisions', 'allSemesters'));
    }

    public function export(Request $request)
    {
        $divisi = $request->filter_divisi;
        $semester = $request->filter_semester;

        $fileName = 'Laporan Karyawan ' . $divisi . ' Semester ' . $semester . '.xlsx';

        return Excel::download(new DataKaryawanExport($divisi, $semester), $fileName);
    }
}
