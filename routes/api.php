<?php

use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\MapelsController;
use App\Http\Controllers\api\TingkatController;
use App\Http\Controllers\api\TahunAjaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('');

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

    Route::get('/tingkat', [TingkatController::class, 'index']);
});
