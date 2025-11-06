<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Datakaryawan;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $filterDivisi = $request->session()->get('filter_divisi', $request->input('filter_divisi'));
        $page = $request->session()->get('page', $request->input('page', 1));
    
        $query = DataKaryawan::orderBy('nip', 'asc');
    
        if ($filterDivisi) {
            $query->where('divisi', $filterDivisi);
        }
    
        $datakaryawans = $query->paginate(10, ['*'], 'page', $page)->appends(['filter_divisi' => $filterDivisi]);
    
        $allDivisions = DataKaryawan::select('divisi')->distinct()->get();
    
        return view('datakaryawans.home', compact('datakaryawans', 'allDivisions', 'filterDivisi'));
    }    

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nilai_managerial' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_1' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_2' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_3' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_4' => 'nullable|numeric|min:0|max:100',
            'rata_rata_kinerja' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_1' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_2' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_3' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_4' => 'nullable|numeric|min:0|max:100',
            'rata_rata_perilaku' => 'nullable|numeric|min:0|max:100',
        ]);
    
        $datakaryawans = DataKaryawan::findOrFail($id);
    
        $penilaians = new Penilaian();
        $penilaians->datakaryawan_id = $id;
        $penilaians->nilai_managerial = $validatedData['nilai_managerial'];
        $penilaians->nilai_kinerja_1 = $validatedData['nilai_kinerja_1'];
        $penilaians->nilai_kinerja_2 = $validatedData['nilai_kinerja_2'];
        $penilaians->nilai_kinerja_3 = $validatedData['nilai_kinerja_3'];
        $penilaians->nilai_kinerja_4 = $validatedData['nilai_kinerja_4'];
        $penilaians->rata_rata_kinerja = $validatedData['rata_rata_kinerja'];
        $penilaians->nilai_perilaku_1 = $validatedData['nilai_perilaku_1'];
        $penilaians->nilai_perilaku_2 = $validatedData['nilai_perilaku_2'];
        $penilaians->nilai_perilaku_3 = $validatedData['nilai_perilaku_3'];
        $penilaians->nilai_perilaku_4 = $validatedData['nilai_perilaku_4'];
        $penilaians->rata_rata_perilaku = $validatedData['rata_rata_perilaku'];
    
        // Menghitung rata-rata prestasi
        $penilaians->rata_rata_prestasi = $penilaians->getRataRataPrestasiAttribute();
        $penilaians->save();
    
        $message = 'Atas nama ' . $datakaryawans->nama . ' telah dinilai.';
    
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }
    
        $request->session()->put('filter_divisi', $request->query('filter_divisi'));
        $request->session()->put('page', $request->query('page', 1));
    
        $pageUrl = $request->query('redirect_to', route('datakaryawans.home'));
        // return redirect($pageUrl)->with('success', $message);
        return redirect()->back()->with('success', $message);
    }
    

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nilai_managerial' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_1' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_2' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_3' => 'nullable|numeric|min:0|max:100',
            'nilai_kinerja_4' => 'nullable|numeric|min:0|max:100',
            'rata_rata_kinerja' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_1' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_2' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_3' => 'nullable|numeric|min:0|max:100',
            'nilai_perilaku_4' => 'nullable|numeric|min:0|max:100',
            'rata_rata_perilaku' => 'nullable|numeric|min:0|max:100',
        ]);

        $penilaians = Penilaian::where('datakaryawan_id', $request->datakaryawan_id)->first();

        if ($penilaians) {
            $penilaians->fill($validatedData);

            // Menghitung rata-rata prestasi
            $penilaians->rata_rata_prestasi = $penilaians->getRataRataPrestasiAttribute();
            $penilaians->save();

            return response()->json(['success' => true, 'message' => 'Penilaian berhasil diperbarui']);
        }

        // Redirect kembali ke halaman terakhir yang dipilih dengan filter divisi yang dipertahankan
        $pageUrl = $request->query('redirect_to', route('datakaryawans.home'));
        return response()->json(['success' => false, 'message' => 'Penilaian tidak ditemukan']);
        return redirect()->back()->with('success', $message);
    }

    public function show(Request $request, $id)
    {
        $datakaryawans = Datakaryawan::findOrFail($id);
        $penilaians = Penilaian::where('datakaryawan_id', $id)->first();

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

        $previousUrl = url()->previous();
        $request->session()->put('previous_url', $previousUrl . $params);

        return view('penilaians.show', compact('datakaryawans', 'penilaians'));
    }
}
