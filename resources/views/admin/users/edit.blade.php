<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Ubah Role User</h1>
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-6 max-w-md">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                &larr; Kembali ke Manajemen User
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Ubah Role User</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6 pb-6 border-b border-gray-200">
                <p class="text-sm text-gray-600">Nama User</p>
                <p class="text-xl font-semibold text-gray-800">{{ $user->name }}</p>
            </div>

            <div class="mb-6 pb-6 border-b border-gray-200">
                <p class="text-sm text-gray-600">Email</p>
                <p class="text-lg text-gray-800">{{ $user->email }}</p>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">
                        Role
                    </label>
                    <select id="role" name="role"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>
                                {{ ucfirst($role) }}
                                @if ($role === 'admin')
                                    (Administrator - Akses Penuh)
                                @elseif($role === 'generalmanager')
                                    (General Manager)
                                @elseif($role === 'seniormanager')
                                    (Senior Manager)
                                @elseif($role === 'manager')
                                    (Manager)
                                @else
                                    (User Biasa)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Deskripsi Role:</h3>
                    <div class="bg-gray-50 p-4 rounded text-sm text-gray-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li><strong>Admin:</strong> Kelola semua user dan manage role</li>
                            <li><strong>General Manager:</strong> Kelola laporan dan approver</li>
                            <li><strong>Senior Manager:</strong> Manager dengan akses lebih</li>
                            <li><strong>Manager:</strong> Kelola tim dan penilaian</li>
                            <li><strong>User:</strong> User biasa dengan akses terbatas</li>
                        </ul>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
