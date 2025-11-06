<div class="flex min-h-screen">
    <div class="w-60 min-h-screen bg-gray-900 text-white flex flex-col">
        <nav class="flex-1 px-2 space-y-1">
            @if (auth()->user()->role === 'user')
                <a href="{{ url('dashboard') }}"
                    class="{{ request()->is('dashboard') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <hr class="border-2 border-gray-100">
                <a href="{{ url('datakaryawans') }}"
                    class="{{ request()->is('datakaryawans') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-user mr-2"></i> Data Karyawan
                </a>
            @elseif(auth()->user()->role === 'manager')
                <a href="{{ url('manager/dashboard') }}"
                    class="{{ request()->is('manager/dashboard') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <hr class="border-2 border-gray-100">
                <a href="{{ url('datakaryawans') }}"
                    class="{{ request()->is('datakaryawans') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-user mr-2"></i> Data Karyawan
                </a>
                <a href="{{ url('laporan') }}"
                    class="{{ request()->is('laporan') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out whitespace-nowrap">
                    <i class="fa-solid fa-file-export mr-2"></i> Laporan
                </a>
            @elseif(auth()->user()->role === 'seniormanager')
                <a href="{{ url('seniormanager/dashboard') }}"
                    class="{{ request()->is('seniormanager/dashboard') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <hr class="border-2 border-gray-100">
                <a href="{{ url('datakaryawans') }}"
                    class="{{ request()->is('datakaryawans') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-user mr-2"></i> Data Karyawan
                </a>
                <a href="{{ url('laporan') }}"
                    class="{{ request()->is('laporan') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out whitespace-nowrap">
                    <i class="fa-solid fa-file-export mr-2"></i> Laporan
                </a>
            @elseif(auth()->user()->role === 'generalmanager')
                <a href="{{ url('generalmanager/dashboard') }}"
                    class="{{ request()->is('generalmanager/dashboard') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <hr class="border-2 border-gray-100">
                <a href="{{ route('generalmanager.home') }}"
                    class="{{ request()->is('generalmanager/home') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out">
                    <i class="fas fa-user mr-2"></i> Data Karyawan
                </a>
                <a href="{{ url('laporan') }}"
                    class="{{ request()->is('laporan') ? 'bg-gray-700' : '' }} no-underline block px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg hover:bg-gray-700 transform transition duration-300 ease-in-out whitespace-nowrap">
                    <i class="fa-solid fa-file-export mr-2"></i> Laporan
                </a>
            @endif
        </nav>
    </div>
    <!-- Main content -->
    <div class="flex-1 p-6">
        {{ $slot }}
    </div>
</div>
