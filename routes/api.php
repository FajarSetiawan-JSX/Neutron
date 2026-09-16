<?php

use App\Http\Controllers\api\AbsensiController;
use App\Http\Controllers\api\AlumniController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\MapelsController;
use App\Http\Controllers\api\NilaiController;
use App\Http\Controllers\api\PertemuanController;
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
    Route::post('/download/{id}', [SiswaController::class, 'download']);

    Route::get('/alumnis', [AlumniController::class, 'index']);
    Route::post('/alumni', [AlumniController::class, 'store']);
    Route::get('/calonalumni', [AlumniController::class, 'calon']);

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
    Route::get('/siswa/{id}', [SiswaController::class, 'recap']);
    Route::patch('/siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);
    Route::post('/siswa/kelas', [SiswaController::class, 'kelas']);
    Route::post('/siswa/mapel', [SiswaController::class, 'mapel']);
    Route::get('/siswa/{id}/rombel', [SiswaController::class, 'rombel']);
    Route::get('/siswa/kelas/{id}/{ta}', [SiswaController::class, 'siswakelas']);


    Route::get('/rombels', [RombelController::class, 'index']);
    Route::post('/rombel', [RombelController::class, 'store']);
    Route::post('/rombel/checkout', [RombelController::class, 'checkout']);
    Route::get('/rombels/{tentor}', [RombelController::class, 'getbytentor']);
    Route::get('/rombel/{id}', [RombelController::class, 'getsiswa']);
    Route::post('/rombel/{tentor}', [RombelController::class, 'storebytentor']);
    Route::patch('/rombel/{id}', [RombelController::class, 'update']);
    Route::delete('/rombel/{id}', [RombelController::class, 'destroy']);

    Route::get('/tingkat', [TingkatController::class, 'index']);

    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::delete('/absensi/{ta}', [AbsensiController::class, 'destroy']);

    Route::get('/nilai', [NilaiController::class, 'index']);

    Route::patch('/siswa/status/{id}', [SiswaController::class, 'status']);
    Route::get('/siswa/{id}/rombel/{tahun}', [SiswaController::class, 'rombel']);
    Route::delete('/siswa/{id}/rombel/{rombel}', [SiswaController::class, 'keluarrombel']);
    Route::get('/siswa/{id}/rombel/{tahun}/saran', [SiswaController::class, 'rombelsaran']);
});

Route::middleware(['auth:sanctum', 'tentor'])->prefix('Tentor')->group(function () {
    Route::get('/rombel', [RombelController::class, 'tentorindex']);
    Route::get('/download/{id}', [SiswaController::class, 'download']);
    Route::post('/absen/pertemuan', [AbsensiController::class, 'store']);
    Route::post('/nilai/pertemuan', [NilaiController::class, 'store']);
    Route::post('/absen/tambahan', [AbsensiController::class, 'tambahan']);
    Route::get('/kelases/{id}', [KelasController::class, 'bytentor']);
    Route::get('/rombel/{id}', [RombelController::class, 'getsiswa']);
    Route::get('/siswa/{id}', [SiswaController::class, 'recap']);

    Route::patch('/pertemuan/{id}', [PertemuanController::class, 'update']);
    Route::get('/{rombel}/pertemuans', [PertemuanController::class, 'index']);
    Route::post('/{rombel}/pertemuan', [PertemuanController::class, 'store']);
    Route::get('/pertemuan/{id}/detail', [PertemuanController::class, 'show']);
    //Route::patch('/kelas/{id}', [KelasController::class, 'update']);
    //Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);
    Route::get('/kelas/{id}/siswa/{ta}', [SiswaController::class, 'getbytentor']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);

    Route::patch('/profile/{id}', [UserProfileController::class, 'profile']);
    Route::post('/image', [UserProfileController::class, 'image']);
    Route::patch('/password/{id}', [UserProfileController::class, 'password']);
});
