<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('datakaryawans.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Nama Lengkap">
                            </div>

                            <div>
                                <label for="nip" class="block text-sm font-medium text-gray-700">Nip</label>
                                <input type="text" name="nip" id="nip"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Nip">
                            </div>

                            <div>
                                <label for="golongan" class="block text-sm font-medium text-gray-700">Golongan</label>
                                <input type="text" name="golongan" id="golongan"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Golongan">
                            </div>

                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Jabatan">
                            </div>

                            <div>
                                <label for="unit_kerja" class="block text-sm font-medium text-gray-700">Unit
                                    Kerja</label>
                                <input type="text" name="unit_kerja" id="unit_kerja"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Unit Kerja">
                            </div>

                            <div>
                                <label for="divisi" class="block text-sm font-medium text-gray-700">Divisi</label>
                                <input type="text" name="divisi" id="divisi"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Divisi">
                            </div>

                            <div>
                                <label for="pejabat_penilai" class="block text-sm font-medium text-gray-700">Pejabat
                                    Penilai</label>
                                <input type="text" name="pejabat_penilai" id="pejabat_penilai"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Nama Atasan Penilai">
                            </div>

                            <div>
                                <label for="general_manager" class="block text-sm font-medium text-gray-700">General
                                    Manager</label>
                                <input type="text" name="General_Manager" id="General_Manager"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Masukkan Nama General Manager">
                            </div>

                            <div>
                                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                                <select name="semester" id="semester"
                                    class="mt-1 block min-w-[400px] px-3 py-2 border border-grey-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-ring-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Pilih Semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                </select>
                            </div>

                            <!-- Button Simpan-->
                            <div class="text-right">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
