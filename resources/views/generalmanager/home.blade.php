<x-app-layout>
    <div class="text-2xl -mt-2">
        <i class="fa-solid fa-users text-3xl mr-3"></i>Penilaian Semester Karyawan PT INKA
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
        <div class="p-6 text-gray-900">

            <div class="flex justify-end ml-auto">
                <form id="filterForm" method="GET" action="{{ route('generalmanager.home') }}"
                    class="flex flex-col items-end">
                    <div class="flex items-center mb-2">
                        <label for="filter_divisi" class="text-m mr-2">Pilih Divisi :</label>
                        <select id="filter_divisi" name="filter_divisi" class="border rounded p-1 w-auto min-w-[400px]"
                            onchange="this.form.submit()">
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
                            class="border rounded p-1 w-auto min-w-[200px]" onchange="this.form.submit()">
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

            <hr class="border-gray-500">
            @if (session('success') || session('error'))
                <div id="alert"
                    class="fixed top-4 right-4 w-80 px-4 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-transform transition-opacity duration-500"
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
                            <th class="px-4 py-2 text-center border border-gray-300">Nip</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Golongan</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Jabatan</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Unit Kerja</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Divisi</th>
                            <th class="px-4 py-2 text-center border border-gray-300">Pejabat Penilai</th>
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
                                <td class="px-4 py-2 text-center border border-gray-300">{{ $datakaryawan->nip }}</td>
                                <td class="px-4 py-2 text-center border border-gray-300">{{ $datakaryawan->golongan }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">{{ $datakaryawan->jabatan }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $datakaryawan->unit_kerja }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $datakaryawan->divisi }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $datakaryawan->pejabat_penilai }}</td>
                                <!-- Button Action -->
                                <td class="px-4 py-2 border border-gray-300">
                                    <div class="flex justify-center space-x-1">
                                        <div class="btn-group flex space-x-1" role="group" aria-label="Basic example">
                                            @if (auth()->user()->role === 'generalmanager' && $datakaryawan->status !== 'approve')
                                                <form action="{{ route('datakaryawans.approve', $datakaryawan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="bg-green-500 text-white hover:bg-green-600 p-2 rounded text-l">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('penilaians.show', ['id' => $datakaryawan->id]) }}"
                                                class="no-underline text-gray-700 p-1 rounded text-xl flex items-center justify-center hover:text-gray-900">
                                                <i class="fa-solid fa-file-lines text-xl"></i>
                                            </a>

                                            @if ($datakaryawan->status !== 'approve')
                                                <a href="{{ route('datakaryawans.edit', ['id' => $datakaryawan->id]) }}"
                                                    class="no-underline text-blue p-1 rounded text-xl flex items-center justify-center">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-2 text-center border border-gray-300">Data Kosong</td>
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
</x-app-layout>
