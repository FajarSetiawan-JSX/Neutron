<?php

use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\TentorRouteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;


Route::get('/', [RoutingController::class, 'welcome'])->name('welcome');

Route::middleware(['auth', 'verified', 'admin'])->prefix('Admin')->group(function () {
    Route::get('/home', [AdminRouteController::class, 'home'])->name('admin.home');
    Route::get('/siswa', [AdminRouteController::class, 'siswa'])->name('admin.siswa');
    Route::get('/presensi', [AdminRouteController::class, 'presensi'])->name('admin.presensi');
    Route::get('/nilai', [AdminRouteController::class, 'nilai'])->name('admin.nilai');

    //master data
    Route::get('/tentor', [AdminRouteController::class, 'tentor'])->name('admin.tentor');
    Route::get('/mapel', [AdminRouteController::class, 'mapel'])->name('admin.mapel');
    Route::get('/tahun', [AdminRouteController::class, 'tahun'])->name('admin.tahun');
    Route::get('/ujian', [AdminRouteController::class, 'ujian'])->name('admin.ujian');
    //kelas & tingkat
    Route::get('/tingkat', [AdminRouteController::class, 'tingkat'])->name('admin.tingkat');
    Route::get('/kelas', [AdminRouteController::class, 'kelas'])->name('admin.kelas');
});


Route::middleware(['auth', 'verified', 'tentor'])->prefix('Tentor')->group(function () {
    Route::get('/home', [TentorRouteController::class, 'home'])->name('tentor.home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
