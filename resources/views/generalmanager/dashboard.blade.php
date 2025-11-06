<x-app-layout>
    <x-slot name="header">
        <p class="text-green-700 text-lg font-bold mt-1 animate-pulse">
            Selamat datang, {{ Auth::user()->name }}!
        </p>
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Sistem Penilaian Semester Karyawan PT INKA') }}
        </h2>
    </x-slot>
</x-app-layout>
