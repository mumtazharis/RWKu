<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeluargaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KepemilikanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\KeluargakuController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ProfileController;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::middleware('prevent-back-history')->group(function () {
    Route::group(['middleware'=>['auth']], function(){
        Route::group(['middleware' => ['cek_login:1']], function(){
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

            Route::group(['prefix' => 'dokumentasi'], function () {
                Route::get('/', [DokumentasiController::class, 'index']);
                Route::post('/list', [DokumentasiController::class, 'list']);
                Route::get('/create', [DokumentasiController::class, 'create']);
                Route::post('/', [DokumentasiController::class, 'store']);
                Route::get('/{id}/edit', [DokumentasiController::class, 'edit']);
                Route::put('/{id}', [DokumentasiController::class, 'update']);
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
                Route::get('/{id}', [KeluargaController::class, 'show']);
                Route::put('/{id}', [KeluargaController::class, 'update']);
            });
    
            Route::group(['prefix' => 'spk'], function () {
                Route::get('/', [SPKController::class, 'index']);
                Route::post('/list', [SPKController::class, 'list']);
                Route::get('/mabac', [SPKController::class, 'showMabac']);
                Route::get('/topsis', [SPKController::class, 'showTopsis']);
                // Route::get('/create', [SPKController::class, 'create']);
                // Route::post('/', [SPKController::class, 'store']);
                // Route::get('/{id}/edit', [SPKController::class, 'edit']);
                // Route::put('/{id}', [SPKController::class, 'update']);
            });

            //keluargaku
            Route::group(['prefix' => 'keluargaku'], function () {
                Route::get('/', [KeluargakuController::class, 'index']);
                Route::post('/list', [KeluargakuController::class, 'list']);
            });

            //profile
            Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

            //keuangan
            Route::group(['prefix' => 'keuangan'], function () {
                Route::get('/', [KeuanganController::class, 'index']);
                Route::post('/list', [KeuanganController::class, 'list']);
                Route::get('/create', [KeuanganController::class, 'create']);
                Route::post('/', [KeuanganController::class, 'store']);

            });
    
        });

        // Route::group(['middleware' => ['cek_login:2']], function(){
        //     Route::resource('manager', ManagerController::class);
        // });
    });
});




// Route::get('/', [WelcomeController::class, 'index']);

// //Data Warga
// Route::group(['prefix' => 'warga'], function () {
//     Route::get('/', [WargaController::class, 'index']);
//     Route::post('/list', [WargaController::class, 'list']);
//     Route::get('/create', [WargaController::class, 'create']);
//     Route::post('/', [WargaController::class, 'store']);
//     Route::get('/{id}', [WargaController::class, 'show']);
//     Route::get('/{id}/edit', [WargaController::class, 'edit']);
//     Route::put('/{id}', [WargaController::class, 'update']);
// });

// //Kegiatan
// Route::group(['prefix' => 'kegiatan'], function () {
//     Route::get('/', [KegiatanController::class, 'index']);
//     Route::post('/list', [KegiatanController::class, 'list']);
//     Route::get('/create', [KegiatanController::class, 'create']);
//     Route::post('/', [KegiatanController::class, 'store']);
//     Route::get('/{id}', [KegiatanController::class, 'show']);
//     Route::get('/{id}/edit', [KegiatanController::class, 'edit']);
//     Route::put('/{id}', [KegiatanController::class, 'update']);
//     Route::delete('/{id}', [KegiatanController::class, 'destroy']);
//     });

// //Kepemilikan
// Route::group(['prefix' => 'kepemilikan'], function () {
//     Route::get('/', [KepemilikanController::class, 'index']);
//     Route::post('/list', [KepemilikanController::class, 'list']);
//     Route::get('/create', [KepemilikanController::class, 'create']);
//     Route::post('/', [KepemilikanController::class, 'store']);
//     Route::get('/{id}', [KepemilikanController::class, 'show']);
//     Route::get('/{id}/edit', [KepemilikanController::class, 'edit']);
//     Route::put('/{id}', [KepemilikanController::class, 'update']);
// });

// //Keluarga
// Route::group(['prefix' => 'keluarga'], function () {
//     Route::get('/', [KeluargaController::class, 'index']);
//     Route::post('/list', [KeluargaController::class, 'list']);
//     Route::get('/create', [KeluargaController::class, 'create']);
//     Route::post('/', [KeluargaController::class, 'store']);
//     Route::get('/{id}/edit', [KeluargaController::class, 'edit']);
//     Route::put('/{id}', [KeluargaController::class, 'update']);
// });




