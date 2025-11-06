<?php

use App\Http\Controllers\CetakPdfController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\generalmanagerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['role:user,manager,seniormanager,generalmanager'])->group(function () {
    Route::prefix('manager')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('manager.dashboard');
    });

    Route::prefix('seniormanager')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('seniormanager.dashboard');
    });

    Route::prefix('generalmanager')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('generalmanager.dashboard');
        Route::get('/', [generalmanagerController::class, 'index'])->name('generalmanager.home');
    });

    Route::prefix('datakaryawans')->group(function () {
        Route::get('/', [DatakaryawanController::class, 'index'])->name('datakaryawans');
        Route::get('/create', [DatakaryawanController::class, 'create'])->name('datakaryawans.create');
        Route::post('/save', [DatakaryawanController::class, 'save'])->name('datakaryawans.save');
        Route::get('/edit/{id}', [DataKaryawanController::class, 'edit'])->name('datakaryawans.edit');
        Route::put('/edit/{id}', [DataKaryawanController::class, 'update'])->name('datakaryawans.update');
        Route::get('/delete/{id}', [DatakaryawanController::class, 'delete'])->name('datakaryawans.delete');
        Route::get('/home', [DataKaryawanController::class, 'index'])->name('datakaryawans.home');
        Route::post('/import', [DataKaryawanController::class, 'import'])->name('data.import');
        Route::put('/{id}/approve', [DataKaryawanController::class, 'approve'])->name('datakaryawans.approve');
        Route::put('/send/{id}', [DataKaryawanController::class, 'send'])->name('datakaryawans.send');
    });

    Route::prefix('penilaians')->group(function () {
        Route::resource('/', PenilaianController::class);
        Route::get('/create', [PenilaianController::class, 'create'])->name(('penilaians.create'));
        Route::get('/show/{id}', [PenilaianController::class, 'show'])->name('penilaians.show');
        Route::post('/store/{id}', [PenilaianController::class, 'store'])->name('penilaians.store');
        Route::post('/update', [PenilaianController::class, 'update'])->name('penilaian.update');
    });

    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/riwayat', [LaporanController::class, 'index'])->name('laporan.riwayat');
        Route::get('/export-excel', [LaporanController::class, 'export'])->name('export.excel');
        Route::get('/cetak-pdf/{id}', [CetakPdfController::class, 'cetakPdf'])->name('cetak.pdf');
    });
});