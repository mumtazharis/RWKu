<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeluargaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KepemilikanController;

Route::get('/', [WelcomeController::class, 'index']);

//Data Warga
Route::group(['prefix' => 'warga'], function () {
    Route::get('/', [WargaController::class, 'index']);
    Route::post('/list', [WargaController::class, 'list']);
    Route::get('/create', [WargaController::class, 'create']);
    Route::post('/', [WargaController::class, 'store']);
    Route::get('/{id}', [WargaController::class, 'show']);
    Route::get('/{id}/edit', [WargaController::class, 'edit']);
    Route::put('/{id}', [WargaController::class, 'update']);
});

//Kegiatan
Route::group(['prefix' => 'kegiatan'], function () {
    Route::get('/', [KegiatanController::class, 'index']);
    Route::post('/list', [KegiatanController::class, 'list']);
    Route::get('/create', [KegiatanController::class, 'create']);
    Route::post('/', [KegiatanController::class, 'store']);
    Route::get('/{id}', [KegiatanController::class, 'show']);
    Route::get('/{id}/edit', [KegiatanController::class, 'edit']);
    Route::put('/{id}', [KegiatanController::class, 'update']);
    Route::delete('/{id}', [KegiatanController::class, 'destroy']);
    });

//Kepemilikan
Route::group(['prefix' => 'kepemilikan'], function () {
    Route::get('/', [KepemilikanController::class, 'index']);
    Route::post('/list', [KepemilikanController::class, 'list']);
    Route::get('/create', [KepemilikanController::class, 'create']);
    Route::post('/', [KepemilikanController::class, 'store']);
    Route::get('/{id}', [KepemilikanController::class, 'show']);
    Route::get('/{id}/edit', [KepemilikanController::class, 'edit']);
    Route::put('/{id}', [KepemilikanController::class, 'update']);
});

//Keluarga
Route::group(['prefix' => 'keluarga'], function () {
    Route::get('/', [KeluargaController::class, 'index']);
    Route::post('/list', [KeluargaController::class, 'list']);
    Route::get('/create', [KeluargaController::class, 'create']);
    Route::post('/', [KeluargaController::class, 'store']);
    Route::get('/{id}/edit', [KeluargaController::class, 'edit']);
    Route::put('/{id}', [KeluargaController::class, 'update']);
});




