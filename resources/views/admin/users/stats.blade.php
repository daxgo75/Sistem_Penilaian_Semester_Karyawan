@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                &larr; Kembali ke Manajemen User
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-8">Statistik User & Role</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="text-gray-600 text-sm font-semibold mb-2">Total User</div>
                <div class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</div>
            </div>

            <div class="bg-red-100 rounded-lg shadow-md p-6">
                <div class="text-red-700 text-sm font-semibold mb-2">Admin</div>
                <div class="text-3xl font-bold text-red-700">{{ $admins }}</div>
            </div>

            <div class="bg-blue-100 rounded-lg shadow-md p-6">
                <div class="text-blue-700 text-sm font-semibold mb-2">User Biasa</div>
                <div class="text-3xl font-bold text-blue-700">{{ $users }}</div>
            </div>

            <div class="bg-purple-100 rounded-lg shadow-md p-6">
                <div class="text-purple-700 text-sm font-semibold mb-2">Manager & Lebih</div>
                <div class="text-3xl font-bold text-purple-700">{{ $totalUsers - $admins - $users }}</div>
            </div>
        </div>

        <!-- Role Distribution Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-200 px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Distribusi Role</h2>
            </div>

            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-6 py-3 text-left font-semibold text-gray-700">Role</th>
                        <th class="border border-gray-300 px-6 py-3 text-center font-semibold text-gray-700">Jumlah User
                        </th>
                        <th class="border border-gray-300 px-6 py-3 text-center font-semibold text-gray-700">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roleStats as $stat)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="border border-gray-300 px-6 py-3">
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-white font-semibold
                                @if ($stat->role === 'admin') bg-red-600
                                @elseif($stat->role === 'generalmanager') bg-purple-600
                                @elseif($stat->role === 'seniormanager') bg-blue-600
                                @elseif($stat->role === 'manager') bg-indigo-600
                                @else bg-gray-600 @endif">
                                    {{ ucfirst($stat->role) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-6 py-3 text-center font-semibold">{{ $stat->count }}</td>
                            <td class="border border-gray-300 px-6 py-3 text-center">
                                {{ round(($stat->count / $totalUsers) * 100, 1) }}%
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border border-gray-300 px-6 py-3 text-center text-gray-500">
                                Tidak ada data statistik.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
