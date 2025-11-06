<x-app-layout>
    <div class="text-2xl -mt-2">
        <i class="fa-solid fa-users text-3xl mr-3"></i>Penilaian Semester Karyawan PT INKA
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
        <div class="p-6 text-gray-900">
            <div class="flex items-center mb-3">
                @if (auth()->user() && (auth()->user()->role === 'manager' || auth()->user()->role === 'seniormanager'))
                    <!-- Button Tambah Data -->
                    <a href="{{ route('datakaryawans.create') }}"
                        class="btn btn-sm btn-light border border-gray-900 rounded h-full font-bold">TAMBAH DATA</a>
                    <!-- Button Trigger Modal -->
                    <button type="button" class="btn btn-sm btn-light ml-2 border border-gray-900 rounded font-bold"
                        data-bs-toggle="modal" data-bs-target="#importModal">
                        IMPORT FILE EXCEL
                    </button>
                @endif
                <div class="flex justify-end ml-auto">
                    <form id="filterForm" method="GET" action="{{ route('datakaryawans.home') }}"
                        class="flex flex-col items-end">
                        <div class="flex items-center mb-2">
                            <label for="filter_divisi" class="text-m mr-2">Pilih Divisi :</label>
                            <select id="filter_divisi" name="filter_divisi"
                                class="border rounded p-1 w-auto min-w-[400px]" onchange="this.form.submit()">
                                <option value="">Semua Divisi</option>
                                @foreach ($allDivisions as $division)
                                    <option value="{{ $division->divisi }}"
                                        {{ request('filter_divisi') == $division->divisi ? 'selected' : '' }}>
                                        {{ $division->divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center">
                            <label for="filter_semester" class="text-m mr-2">Semester :</label>
                            <select id="filter_semester" name="filter_semester"
                                class="border rounded p-1 w-auto min-w-[160px]" onchange="this.form.submit()">
                                <option value="">Semua Semester</option>
                                @foreach ($allSemesters as $semester)
                                    <option value="{{ $semester->semester }}"
                                        {{ request('filter_semester') == $semester->semester ? 'selected' : '' }}>
                                        {{ $semester->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="border-gray-500">
            @if (session('success') || session('error'))
                <div id="alert"
                    class="fixed top-4 right-4 w-80 px-5 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-transform transition-opacity duration-500"
                    role="alert"
                    style="background-color: {{ session('success') ? '#38a169' : '#e53e3e' }}; border-color: {{ session('success') ? '#38a169' : '#e53e3e' }}; color: white;">
                    <strong class="font-bold">
                        {{ session('success') ? 'Success!' : 'Error!' }}
                    </strong>
                    <span class="block sm:inline">
                        {{ session('success') ? session('success') : session('error') }}
                    </span>
                    <button onclick="closeAlert()"
                        class="absolute top-2 right-2 p-1 text-white hover:text-opacity-75 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const alertBox = document.getElementById('alert');
                        alertBox.classList.remove('translate-x-full', 'opacity-0');
                        alertBox.classList.add('translate-x-0', 'opacity-100');
                    });

                    function closeAlert() {
                        const alertBox = document.getElementById('alert');
                        alertBox.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => {
                            alertBox.style.display = 'none';
                        }, 500);
                    }
                </script>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border-separate border-spacing-0 text-sm">
                    <thead class="bg-black text-white">
                        <tr>
                            <th class="px-2 py-1 text-center border border-gray-300">No</th>
                            <th class="px-4 py-1 text-center border border-gray-300">Nama</th>
                            <th class="px-2 py-1 text-center border border-gray-300">Nip</th>
                            <th class="px-2 py-1 text-center border border-gray-300">Golongan</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Jabatan</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Unit Kerja</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Divisi</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Pejabat Penilai</th>
                            <th class="px-2 py-2 text-center border border-gray-300">Status</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $no = 1 + ($datakaryawans->currentPage() - 1) * $datakaryawans->perPage();
                        @endphp
                        @forelse ($datakaryawans as $datakaryawan)
                            <tr>
                                <td class="px-2 py-1 text-center border border-gray-300">{{ $no++ }}</td>
                                <td class="px-4 py-1 border border-gray-300">{{ $datakaryawan->nama }}</td>
                                <td class="px-2 py-1 text-center border border-gray-300">{{ $datakaryawan->nip }}</td>
                                <td class="px-2 py-1 text-center border border-gray-300">{{ $datakaryawan->golongan }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">{{ $datakaryawan->jabatan }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $datakaryawan->unit_kerja }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $datakaryawan->divisi }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $datakaryawan->pejabat_penilai }}</td>
                                <td
                                    class="px-2 py-2 text-center border border-gray-300 {{ $datakaryawan->status == 'approve' ? 'bg-green-300' : 'bg-yellow-200' }}">
                                    {{ $datakaryawan->status }}
                                </td>
                                <!-- Button Action -->
                                <td class="px-4 py-2 text-center border border-gray-300">
                                    <div class="flex justify-center space-x-1">
                                        <div class="btn-group flex space-x-1" role="group" aria-label="Basic example">
                                            @if (auth()->user()->role === 'generalmanager' && $datakaryawan->status !== 'approve')
                                                <form action="{{ route('datakaryawans.approve', $datakaryawan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-green-500 text-white hover:bg-green-600 p-1 rounded text-m">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            @if (
                                                (auth()->user()->role === 'manager' || auth()->user()->role === 'seniormanager') &&
                                                    $datakaryawan->status !== 'send' &&
                                                    $datakaryawan->status !== 'approve' &&
                                                    $datakaryawan->penilaians)
                                                <form action="{{ route('datakaryawans.send', $datakaryawan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-blue-500 text-white hover:bg-blue-600 p-2 rounded text-m">
                                                        Kirim
                                                    </button>
                                                </form>
                                            @endif

                                            @if (auth()->user() && (auth()->user()->role === 'manager' || auth()->user()->role === 'seniormanager'))
                                                @if (!$datakaryawan->penilaians)
                                                    <button type="button"
                                                        class="bg-green-300 text-black hover:bg-green-400 p-2 rounded text-m text-extrabold openModalBtn"
                                                        data-id="{{ $datakaryawan->id }}">Nilai</button>
                                                @endif
                                            @endif

                                            <a href="{{ route('penilaians.show', ['id' => $datakaryawan->id]) }}"
                                                class="no-underline text-gray-700 p-1 rounded text-xl flex items-center justify-center hover:text-gray-900">
                                                <i class="fa-solid fa-file-lines text-xl"></i>
                                            </a>

                                            @if (auth()->user() && (auth()->user()->role === 'manager' || auth()->user()->role === 'seniormanager'))
                                                @if ($datakaryawan->status !== 'approve')
                                                    <a href="{{ route('datakaryawans.edit', ['id' => $datakaryawan->id]) }}"
                                                        class="no-underline text-blue p-1 rounded text-xl flex items-center justify-center">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                            @endif

                                            @if (auth()->user() && (auth()->user()->role === 'manager' || auth()->user()->role === 'seniormanager'))
                                                <a href="{{ route('datakaryawans.delete', ['id' => $datakaryawan->id]) }}"
                                                    class="no-underline text-red-500 p-1 rounded text-xl flex items-center justify-center">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-2 text-center border border-gray-300">Data Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center me-4">
            <div class="pagination-wrapper">
                {{ $datakaryawans->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modal import file excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Excel File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Agar dapat mengimport data menggunakan excel, diantaranya:
                    <li>Diharapkan menggunakan format excel (xlsx).
                    <li>Data excel harus sesuai dengan format tambah data.
                        <hr class="border-gray-500">
                        <form action="{{ route('data.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="" disabled selected>Pilih Semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" id="file" name="file"
                                    accept=".xlsx, .xls" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penilaian -->
    <div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nilaiModalLabel">Penilaian Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto" style="max-height: 80vh;">
                    <form id="nilaiForm" method="POST">
                        @csrf
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 border-2 border-gray-300 p-2 bg-gray-200 text-left text-l text-center font-medium text-gray-800 uppercase tracking-wider">
                                        UNSUR YANG DINILAI</th>
                                    <th
                                        class="px-6 py-3 border-2 border-gray-300 p-2 bg-gray-200 text-left text-l text-center font-medium text-gray-800 uppercase tracking-wider">
                                        NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="border border-gray-300 p-2 font-semibold">
                                        <b>A. MANAJERIAL (Khusus Pejabat Struktural)</b>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        1. Kemampuan
                                        Manajerial (Perencanaan, Pengorganisasian, Penggerakan, Pengendalian &
                                        Pengawasan)</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_managerial" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border-gray-300 p-2 whitespace-nowrap text-l font-medium text-gray-900">
                                        <b>B. KINERJA</b>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        1. Jumlah / Beban
                                        Kerja yang diselesaikan</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_kinerja_1" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        2. Kualitas kerja
                                        yang dihasilkan</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_kinerja_2" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        3. Pemeliharaan
                                        Peralatan dan Perlengkapan</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_kinerja_3" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        4. Paham Hubungan
                                        antar pekerjaan yang menjadi tugas dan tanggung jawabnya</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_kinerja_4" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border-2 border-gray-300 p-2 bg-gray-100 whitespace-nowrap text-l text-center font-medium text-gray-900">
                                        <b>Rata-rata Nilai Kinerja</b>
                                    </td>
                                    <td
                                        class="px-6 py-4 border-2 border-gray-300 p-2 bg-gray-100 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="rata_rata_kinerja" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border-gray-300 p-2 whitespace-nowrap text-l font-medium text-gray-900">
                                        <b>C. PERILAKU</b>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        1. Tanggung Jawab &
                                        Kerjasama</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_perilaku_1" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        2. Inisiatif dan
                                        Kreatifitas</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_perilaku_2" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        3. Tata Krama dan
                                        Kejujuran</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_perilaku_3" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-l text-gray-500">
                                        4. Disiplin (Mematuhi
                                        peraturan dan tata tertib perusahaan)</td>
                                    <td
                                        class="px-6 py-4 border border-gray-300 p-2 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="nilai_perilaku_4" min="0" max="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-6 py-4 border-2 border-gray-300 p-2 bg-gray-100 whitespace-nowrap text-l text-center font-medium text-gray-900">
                                        <b>Rata-rata Nilai Perilaku</b>
                                    </td>
                                    <td
                                        class="px-6 py-4 border-2 border-gray-300 p-2 bg-gray-100 whitespace-nowrap text-sm text-gray-500">
                                        <input type="number" class="w-full p-2 border rounded"
                                            name="rata_rata_perilaku" min="0" max="100">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nilaiModal = new bootstrap.Modal(document.getElementById('nilaiModal'));
            var openModalBtns = document.querySelectorAll('.openModalBtn');
            var nilaiForm = document.getElementById('nilaiForm');

            openModalBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var karyawanId = this.getAttribute('data-id');
                    nilaiForm.action = '/penilaians/store/' +
                        karyawanId; // Ubah sesuai route yang benar
                    nilaiModal.show();
                });
            });

            document.querySelector('.btn-close').addEventListener('click', function() {
                nilaiModal.hide();
            });

            window.addEventListener('click', function(event) {
                if (event.target === document.querySelector('.modal')) {
                    nilaiModal.hide();
                }
            });
        });
    </script>
</x-app-layout>
