<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\MapelsController;
use App\Http\Controllers\api\Profile\UserProfileController;
use App\Http\Controllers\api\RombelController;
use App\Http\Controllers\api\SiswaController;
use App\Http\Controllers\api\TingkatController;
use App\Http\Controllers\api\TahunAjaranController;
use App\Http\Controllers\api\TentorController;
use App\Http\Controllers\api\UjianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'store']);
Route::middleware(['auth:sanctum', 'admin'])->prefix('Admin')->group(function () {
    Route::get('/mapels', [MapelsController::class, 'index']);
    Route::post('/mapel', [MapelsController::class, 'store']);
    Route::patch('/mapel/{id}', [MapelsController::class, 'update']);
    Route::delete('/mapel/{id}', [MapelsController::class, 'destroy']);

    Route::get('/kelases', [KelasController::class, 'index']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::patch('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

    Route::get('/tahunajarans', [TahunAjaranController::class, 'index']);
    Route::post('/tahunajarans', [TahunAjaranController::class, 'store']);
    Route::patch('/tahunajaran/{id}', [TahunAjaranController::class, 'update']);

    Route::get('/ujians', [UjianController::class, 'index']);
    Route::post('/ujian', [UjianController::class, 'store']);
    Route::patch('/ujian/{id}', [UjianController::class, 'update']);
    Route::patch('/ujian/status/{id}', [UjianController::class, 'status']);
    Route::delete('/ujian/{id}', [UjianController::class, 'destroy']);

    Route::get('/tentors', [TentorController::class, 'index']);
    Route::post('/tentor', [TentorController::class, 'store']);
    Route::post('/tentor/kelas', [TentorController::class, 'kelas']);
    Route::post('/tentor/mapel', [TentorController::class, 'mapel']);
    Route::get('/tentor/mapel', [TentorController::class, 'mapelAvailable']);
    Route::patch('/tentor/{id}', [TentorController::class, 'update']);
    Route::delete('/tentor/{id}', [TentorController::class, 'destroy']);
    Route::patch('/tentor/status/{id}', [TentorController::class, 'status']);
    Route::patch('/tentor/reset/{id}', [TentorController::class, 'reset']);
    Route::get('/tentor/kelas/{id}', [TentorController::class, 'kelasAvailable']);

    Route::get('/siswas', [SiswaController::class, 'index']);
    Route::post('/siswa', [SiswaController::class, 'store']);
    Route::patch('/siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);
    Route::post('/siswa/kelas', [SiswaController::class, 'kelas']);
    Route::post('/siswa/mapel', [SiswaController::class, 'mapel']);
    Route::patch('/siswa/status/{id}', [SiswaController::class, 'status']);

    Route::get('/rombels', [RombelController::class, 'index']);
    Route::post('/rombel', [RombelController::class, 'store']);
    Route::patch('/rombel/{id}', [RombelController::class, 'update']);
    Route::delete('/rombel/{id}', [RombelController::class, 'destroy']);

    Route::get('/tingkat', [TingkatController::class, 'index']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);

    Route::patch('/profile/{id}', [UserProfileController::class, 'profile']);
    Route::post('/image', [UserProfileController::class, 'image']);
    Route::patch('/password/{id}', [UserProfileController::class, 'password']);
});
