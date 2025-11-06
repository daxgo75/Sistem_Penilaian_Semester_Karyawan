<?php

namespace App\Http\Controllers;

use App\Imports\DataKaryawanImport;
use App\Models\DataKaryawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Matrix\Operators\Division;

class DataKaryawanController extends Controller
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

        return view('datakaryawans.home', compact('datakaryawans', 'allDivisions', 'allSemesters'));
    }

    public function create()
    {
        $allDivisions = DataKaryawan::select('divisi')->distinct()->get();
        return view('datakaryawans.create', compact('allDivisions'));
    }
    
    public function save(Request $request)
    {
        $validation = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'golongan' => 'required',
            'jabatan' => 'required',
            'unit_kerja' => 'required',
            'divisi' => 'required',
            'pejabat_penilai' => 'required',
            'semester' => 'required',
            'General_Manager' => 'required',
        ]);
    
        $data = DataKaryawan::create($validation);
    
        if ($data) {
            session()->flash('success', 'Data berhasil ditambahkan');
        } else {
            session()->flash('error', 'Data perlu diperbaiki');
        }
    
        return redirect()->route('datakaryawans.home');
    }
    

    public function edit($id)
    {
        $datakaryawans = DataKaryawan::find($id);

        return view('datakaryawans.edit', compact('datakaryawans'));
    }

    public function update(Request $request, $id)
    {
        $datakaryawans = DataKaryawan::find($id);

        $validation = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'golongan' => 'required',
            'jabatan' => 'required',
            'unit_kerja' => 'required',
            'divisi' => 'required',
            'pejabat_penilai' => 'required',
            'semester' => 'required',
            'General_Manager' => 'required',
        ]);

        $datakaryawans = DataKaryawan::find($id);
        $datakaryawans->update($validation);

        $filterDivisi = $request->session()->get('filter_divisi');
        $filterSemester = $request->session()->get('filter_semester');

        $params = $filterDivisi ? '?' . http_build_query([
            'filter_divisi' => $datakaryawans->divisi
        ]) : '';

        if ($filterSemester) {
            $params .= $params ? '&' : '?';
            $params .= http_build_query([
                'filter_semester' => $datakaryawans->semester
            ]);
        }

        return redirect(route('datakaryawans.home') . $params)->with('success', 'Data untuk ' .$datakaryawans->nama. ' berhasil di ubah.');
    }

    public function delete($id)
    {
        $datakaryawans = DataKaryawan::find($id);

        if (! $datakaryawans) {
            return redirect()->back()->with('error', 'Data untuk ' .$datakaryawans->nama. ' tidak ditemukan.');
        }
        $datakaryawans->delete();

        return redirect()->back()->with('success', 'Data untuk ' .$datakaryawans->nama. ' berhasil di hapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'semester' => 'required|string',
        ]);
    
        $semester = $request->input('semester');
    
        try {
            $rows = Excel::toArray(new DataKaryawanImport($semester), $request->file('file'));
    
            $expectedColumns = ['no', 'nama', 'nip', 'golongan', 'jabatan', 'unit_kerja', 'divisi', 'pejabat_penilai', 'general_manager'];
    
            $header = array_keys($rows[0][0]);
    
            foreach ($expectedColumns as $column) {
                if (!in_array($column, $header)) {
                    return redirect()->route('datakaryawans.home')->with('error', "Kolom '$column' tidak ditemukan dalam file Excel.");
                }
            }

            Excel::import(new DataKaryawanImport($semester), $request->file('file'));
    
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->route('datakaryawans.home')->with('error', 'File Excel tidak sesuai dengan format yang ditentukan.');
        } catch (\Exception $e) {
            return redirect()->route('datakaryawans.home')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    
        return redirect()->route('datakaryawans.home')->with('success', 'Data karyawan berhasil diimport.');
    }        

    public function approve($id)
    {
        $datakaryawans = DataKaryawan::find($id);
        $datakaryawans->status = 'approve';
        $datakaryawans->save();

        return redirect()->back()->with('success', 'Penilaian untuk ' .$datakaryawans->nama. ' berhasil di-approve.');
    }

    public function send($id)
    {
        $datakaryawans = DataKaryawan::find($id);
        $datakaryawans->status = 'send';
        $datakaryawans->save();

        return redirect()->back()->with('success', 'Data atas nama ' .$datakaryawans->nama. ' berhasil di-kirim ke General Manager');
    }
}
