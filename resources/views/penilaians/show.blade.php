<x-app-layout>
    <x-slot name="header">
        <div class="bg-black text-white text-center py-2">
            <span class="text-lg font-bold">PENILAIAN PRESTASI KARYAWAN SEMESTER</span>
            <span class="text-lg font-bold">
                {{ $datakaryawans->semester }} TAHUN
                {{ \Carbon\Carbon::parse($datakaryawans->created_at)->format('Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Session::has('success'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <div class="mb-4 rounded-lg border border-gray-200 overflow-x-auto">
                        <div class="bg-gray-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold">Data Karyawan</h3>
                        </div>
                        <div class="p-4">
                            <table class="table-auto w-full">
                                <tbody>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold w-1/3">NAMA</td>
                                        <td class="border px-4 py-2 w-2/3">{{ $datakaryawans->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">NIP</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">GOLONGAN</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->golongan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">JABATAN</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">UNIT KERJA</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->unit_kerja }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">DIVISI</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->divisi }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">PEJABAT PENILAI</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->pejabat_penilai }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border px-4 py-2 font-semibold">GENERAL MANAGER</td>
                                        <td class="border px-4 py-2">{{ $datakaryawans->General_Manager }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 overflow-x-auto">
                        <div class="bg-gray-100 p-4 rounded-t-lg">
                            <h3 class="text-lg font-semibold">Penilaian Karyawan</h3>
                        </div>
                        <div class="p-4">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="border-2 border-gray-300 p-2 text-center">UNSUR YANG DINILAI</th>
                                        <th class="border-2 border-gray-300 p-2 text-center">NILAI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Managerial Section -->
                                    <tr>
                                        <td colspan="2" class="border border-gray-300 p-2 font-semibold">A.
                                            MANAJERIAL (Khusus Pejabat Struktural)</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Kemampuan Manajerial (Perencanaan,
                                            Pengorganisasian, Penggerakan, Pengendalian & Pengawasan)</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_managerial ?? '-' }}</td>
                                    </tr>
                                    <!-- Kinerja Section -->
                                    <tr>
                                        <td colspan="2" class="border border-gray-300 p-2 font-semibold">B. KINERJA
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Jumlah / Beban Kerja yang diselesaikan
                                        </td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_kinerja_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Kualitas kerja yang dihasilkan</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_kinerja_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Pemeliharaan Peralatan dan Perlengkapan
                                        </td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_kinerja_3 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Paham Hubungan antar pekerjaan yang
                                            menjadi tugas dan tanggung jawabnya</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_kinerja_4 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 bg-gray-100 font-semibold text-center">
                                            Rata-rata Nilai Kinerja</td>
                                        <td class="border border-gray-300 p-2 bg-gray-100 text-center">
                                            {{ $penilaians->rata_rata_kinerja ?? '-' }}</td>
                                    </tr>
                                    <!-- Perilaku Section -->
                                    <tr>
                                        <td colspan="2" class="border border-gray-100 p-2 font-semibold">C. PERILAKU
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Tanggung Jawab & Kerjasama</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_perilaku_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Inisiatif dan Kreatifitas</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_perilaku_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Tata Krama dan Kejujuran</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_perilaku_3 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2">Disiplin (Mematuhi peraturan dan tata
                                            tertib perusahaan)</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $penilaians->nilai_perilaku_4 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 bg-gray-100 font-semibold text-center">
                                            Rata-rata Nilai Perilaku</td>
                                        <td class="border border-gray-300 p-2 bg-gray-100 text-center">
                                            {{ $penilaians->rata_rata_perilaku ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300 p-2 bg-gray-300 font-semibold text-center">
                                            Rata-rata Nilai Prestasi Karyawan</td>
                                        <td class="border border-gray-300 p-2 bg-gray-300 text-center">
                                            {{ $penilaians->rata_rata_prestasi ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end space-x-4">
                        @if (Auth::user()->role === 'generalmanager')
                            <a href="{{ route('generalmanager.home', [
                                'filter_divisi' => session('filter_divisi'),
                                'filter_semester' => session('filter_semester'),
                            ]) }}"
                                class="btn btn-secondary bg-gray-700 text-white py-2 px-4 rounded">
                                Kembali
                            </a>
                        @else
                            <a href="{{ route('datakaryawans.home', [
                                'filter_divisi' => session('filter_divisi'),
                                'filter_semester' => session('filter_semester'),
                            ]) }}"
                                class="btn btn-secondary bg-gray-700 text-white py-2 px-4 rounded">
                                Kembali
                            </a>
                        @endif

                        @if (auth()->user() &&
                                in_array(auth()->user()->role, ['manager', 'seniormanager', 'generalmanager']) &&
                                $datakaryawans->status !== 'approve')
                            <button onclick="openEditPopup()"
                                class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Edit Nilai</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-900 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
                <div class="bg-gray-100 px-4 py-2">
                    <h3 class="text-lg font-semibold">Edit Nilai Karyawan</h3>
                </div>
                <div class="p-4">
                    <form id="editForm">
                        @csrf
                        <input type="hidden" id="karyawanId" name="datakaryawan_id" value="{{ $datakaryawans->id }}">
                        <div class="mb-4">
                            <label for="nilai_managerial" class="block text-sm font-medium text-gray-500">Kemampuan
                                Manajerial</label>
                            <input type="number" name="nilai_managerial" id="nilai_managerial"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_managerial ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_kinerja_1" class="block text-sm font-medium text-gray-500">Jumlah /
                                Beban Kerja yang diselesaikan</label>
                            <input type="number" name="nilai_kinerja_1" id="nilai_kinerja_1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_kinerja_1 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_kinerja_2" class="block text-sm font-medium text-gray-500">Kualitas
                                kerja yang dihasilkan</label>
                            <input type="number" name="nilai_kinerja_2" id="nilai_kinerja_2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_kinerja_2 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_kinerja_3" class="block text-sm font-medium text-gray-500">Pemeliharaan
                                Peralatan dan Perlengkapan</label>
                            <input type="number" name="nilai_kinerja_3" id="nilai_kinerja_3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_kinerja_3 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_kinerja_4" class="block text-sm font-medium text-gray-500">
                                Hubungan antar pekerjaan yang menjadi tugas dan tanggung jawabnya</label>
                            <input type="number" name="nilai_kinerja_4" id="nilai_kinerja_4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_kinerja_4 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="rata_rata_kinerja" class="block text-sm font-medium font-bold text-gray-700">
                                Rata-rata Kinerja</label>
                            <input type="number" name="rata_rata_kinerja" id="rata_rata_kinerja"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->rata_rata_kinerja ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_perilaku_1" class="block text-sm font-medium text-gray-500">Tanggung
                                Jawab & Kerjasama</label>
                            <input type="number" name="nilai_perilaku_1" id="nilai_perilaku_1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_perilaku_1 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_perilaku_2" class="block text-sm font-medium text-gray-500">Inisiatif
                                dan Kreatifitas</label>
                            <input type="number" name="nilai_perilaku_2" id="nilai_perilaku_2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_perilaku_2 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_perilaku_3" class="block text-sm font-medium text-gray-500">Tata Krama
                                dan Kejujuran</label>
                            <input type="number" name="nilai_perilaku_3" id="nilai_perilaku_3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_perilaku_3 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="nilai_perilaku_4" class="block text-sm font-medium text-gray-500">Disiplin
                                (Mematuhi peraturan dan tata tertib perusahaan)</label>
                            <input type="number" name="nilai_perilaku_4" id="nilai_perilaku_4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->nilai_perilaku_4 ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="rata_rata_perilaku"
                                class="block text-sm font-medium font-bold text-gray-700">Rata-rata
                                Perilaku</label>
                            <input type="number" name="rata_rata_perilaku" id="rata_rata_perilaku"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ $penilaians->rata_rata_perilaku ?? '' }}">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeEditPopup()"
                                class="btn btn-secondary bg-gray-500 text-white py-2 px-4 rounded mr-2">Close</button>
                            <button type="submit"
                                class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditPopup() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditPopup() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('{{ route('penilaian.update') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat menyimpan data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data.');
                });
        });
    </script>
</x-app-layout>
