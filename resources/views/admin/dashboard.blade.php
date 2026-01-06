<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8"> {{-- tambah pb agar ada jarak bawah --}}
            <p class="text-green-600 dark:text-green-400 text-xl font-extrabold tracking-tight animate-pulse">
                Selamat datang kembali, {{ Auth::user()->name }}!
            </p>
            <h2
                class="mt-2 font-bold text-3xl text-gray-900 dark:text-white 
                       leading-normal border-b-0 no-underline">
                {{-- hilangkan garis bawah --}}
                {{ __('Dashboard Admin') }}
                <span class="block text-lg font-medium text-gray-600 dark:text-gray-400 mt-1">
                    Sistem Penilaian Semester Karyawan PT INKA
                </span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                <!-- Card 1: Manajemen User -->
                <a href="{{ route('admin.users.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-200 dark:border-gray-700">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 opacity-0 group-hover:opacity-20 transition-opacity">
                    </div>

                    <div class="relative p-8">
                        <div class="flex items-center space-x-5">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users-cog text-2xl text-white"></i>
                                </div>
                            </div>
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Manajemen User
                                </p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                    Kelola pengguna & role
                                </p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Tambah, edit, hapus user serta atur hak akses dengan mudah
                                </p>
                            </div>
                        </div>
                        <div
                            class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all">
                            <i class="fas fa-arrow-right text-blue-600 text-lg"></i>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Statistik -->
                <a href="{{ route('admin.stats.index') }}"
                    class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-200 dark:border-gray-700">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-20 transition-opacity">
                    </div>

                    <div class="relative p-8">
                        <div class="flex items-center space-x-5">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-16 w-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                    <i class="fas fa-chart-bar text-2xl text-white"></i>
                                </div>
                            </div>
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Statistik & Analitik
                                </p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                    Distribusi role & total user
                                </p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Pantau jumlah karyawan per divisi dan statistik penilaian real-time
                                </p>
                            </div>
                        </div>
                        <div
                            class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all">
                            <i class="fas fa-arrow-right text-indigo-600 text-lg"></i>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Footer kecil -->
            <div class="mt-12 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} PT Industri Kereta Api (Persero) • Sistem Penilaian Semester
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
