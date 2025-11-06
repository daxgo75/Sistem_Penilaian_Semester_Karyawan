<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKaryawan;

class GeneralManagerController extends Controller
{
    public function index(Request $request)
    {
        $query = DataKaryawan::whereIn('status', ['send', 'approve'])->orderBy('nip', 'asc');
    
        if ($request->filled('filter_divisi')) {
            $query->where('divisi', $request->filter_divisi);
        }
    
        if ($request->filled('filter_semester')) {
            $query->where('semester', $request->filter_semester);
        }
    
        $datakaryawans = $query->paginate(10)->appends([
            'filter_divisi' => $request->filter_divisi,
            'filter_semester' => $request->filter_semester
        ]);
    
        $allDivisions = DataKaryawan::select('divisi')
            ->whereIn('status', ['send', 'approve'])
            ->distinct()
            ->get();
    
        $allSemesters = DataKaryawan::select('semester')
            ->whereIn('status', ['send', 'approve'])
            ->distinct()
            ->get();
    
        return view('generalmanager.home', compact('datakaryawans', 'allDivisions', 'allSemesters'));
    }
    
}
