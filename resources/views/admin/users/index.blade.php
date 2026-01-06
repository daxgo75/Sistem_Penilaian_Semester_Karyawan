<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
            <a href="{{ route('admin.stats.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Lihat Statistik
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-6">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Terdaftar</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                            <td class="border border-gray-300 px-4 py-2 font-semibold">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-white font-semibold
                                @if ($user->role === 'admin') bg-red-600
                                @elseif($user->role === 'generalmanager') bg-purple-600
                                @elseif($user->role === 'seniormanager') bg-blue-600
                                @elseif($user->role === 'manager') bg-indigo-600
                                @else bg-gray-600 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm inline-block mr-1">
                                    Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-3 rounded text-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                Tidak ada user ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
