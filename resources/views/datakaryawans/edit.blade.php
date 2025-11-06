<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('datakaryawans.update', $datakaryawans->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ $datakaryawans->nama }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nip">Nip</label>
                                    <input type="text" name="nip" class="form-control"
                                        value="{{ $datakaryawans->nip }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="golongan">Golongan</label>
                                    <input type="text" name="golongan" class="form-control"
                                        value="{{ $datakaryawans->golongan }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"
                                        value="{{ $datakaryawans->jabatan }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="unit_kerja">Unit Kerja</label>
                                    <input type="text" name="unit_kerja" class="form-control"
                                        value="{{ $datakaryawans->unit_kerja }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="divisi">Divisi</label>
                                    <input type="text" name="divisi" class="form-control"
                                        value="{{ $datakaryawans->divisi }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pejabat_penilai">Pejabat Penilai</label>
                                    <input type="text" name="pejabat_penilai" class="form-control"
                                        value="{{ $datakaryawans->pejabat_penilai }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="general_manager">General Manager</label>
                                    <input type="text" name="General_Manager" class="form-control"
                                        value="{{ $datakaryawans->General_Manager }}">
                                </div>
                                <div>
                                    <label for="semester"
                                        class="block text-sm font-medium text-gray-700">Semester</label>
                                    <select name="semester" id="semester"
                                        class="mt-1 block min-w-[400px] px-3 py-2 border border-grey-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-ring-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" disabled selected>Pilih Semester</option>
                                        <option value="1">Semester 1</option>
                                        <option value="2">Semester 2</option>
                                    </select>
                                </div>
                                <!-- Button Update-->
                                <div class="form-group text-right mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
