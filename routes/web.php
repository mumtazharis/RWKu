<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;

use App\Http\Controllers\rw\KegiatanController;
use App\Http\Controllers\rw\KeluargaController;
use App\Http\Controllers\rw\WargaController;
use App\Http\Controllers\rw\KepemilikanController;
use App\Http\Controllers\rw\DokumentasiController;
use App\Http\Controllers\rw\SPKController;
use App\Http\Controllers\rw\KeluargakuController;
use App\Http\Controllers\rw\KeuanganController;
use App\Http\Controllers\rw\ProfileController;


use App\Http\Controllers\warga\WargaKegiatanCOntroller;
use App\Http\Controllers\warga\WargaDokumentasiController;
use App\Http\Controllers\warga\WargaKeuanganController;
use App\Http\Controllers\warga\WargaKeluargakuController;
use App\Http\Controllers\warga\WargaProfileController;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::middleware('prevent-back-history')->group(function () {
    Route::middleware(['auth'])->group(function () {

        // Rute untuk pengguna dengan peran RW (role_id: 1)
        Route::prefix('rw')->middleware(['cek_login:1'])->group(function () {
           

            // Data Warga
            Route::prefix('warga')->group(function () {
                Route::get('/', [WargaController::class, 'index']);
                Route::post('/list', [WargaController::class, 'list']);
                Route::get('/create', [WargaController::class, 'create']);
                Route::post('/', [WargaController::class, 'store']);
                Route::get('/{id}', [WargaController::class, 'show']);
                Route::get('/{id}/edit', [WargaController::class, 'edit']);
                Route::put('/{id}', [WargaController::class, 'update']);
            });

            // Kegiatan
            Route::prefix('kegiatan')->group(function () {
                Route::get('/', [KegiatanController::class, 'index']);
                Route::post('/list', [KegiatanController::class, 'list']);
                Route::get('/create', [KegiatanController::class, 'create']);
                Route::post('/', [KegiatanController::class, 'store']);
                Route::get('/{id}', [KegiatanController::class, 'show']);
                Route::get('/{id}/edit', [KegiatanController::class, 'edit']);
                Route::put('/{id}', [KegiatanController::class, 'update']);
                Route::delete('/{id}', [KegiatanController::class, 'destroy']);
            });

            // Dokumentasi
            Route::prefix('dokumentasi')->group(function () {
                Route::get('/', [DokumentasiController::class, 'index']);
                Route::post('/list', [DokumentasiController::class, 'list']);
                Route::get('/create', [DokumentasiController::class, 'create']);
                Route::post('/', [DokumentasiController::class, 'store']);
                Route::get('/{id}/edit', [DokumentasiController::class, 'edit']);
                Route::put('/{id}', [DokumentasiController::class, 'update']);
            });

            // Kepemilikan
            Route::prefix('kepemilikan')->group(function () {
                Route::get('/', [KepemilikanController::class, 'index']);
                Route::post('/list', [KepemilikanController::class, 'list']);
                Route::get('/create', [KepemilikanController::class, 'create']);
                Route::post('/', [KepemilikanController::class, 'store']);
                Route::get('/{id}', [KepemilikanController::class, 'show']);
                Route::get('/{id}/edit', [KepemilikanController::class, 'edit']);
                Route::put('/{id}', [KepemilikanController::class, 'update']);
            });

            // Keluarga
            Route::prefix('keluarga')->group(function () {
                Route::get('/', [KeluargaController::class, 'index']);
                Route::post('/list', [KeluargaController::class, 'list']);
                Route::get('/create', [KeluargaController::class, 'create']);
                Route::post('/', [KeluargaController::class, 'store']);
                Route::get('/{id}/edit', [KeluargaController::class, 'edit']);
                Route::get('/{id}', [KeluargaController::class, 'show']);
                Route::put('/{id}', [KeluargaController::class, 'update']);
            });

            // SPK
            Route::prefix('spk')->group(function () {
                Route::get('/', [SPKController::class, 'index']);
                Route::post('/list', [SPKController::class, 'list']);
                Route::get('/mabac', [SPKController::class, 'showMabac']);
                Route::get('/topsis', [SPKController::class, 'showTopsis']);
            });

            // Keluargaku
            Route::prefix('keluargaku')->group(function () {
                Route::get('/', [KeluargakuController::class, 'index']);
                Route::post('/list', [KeluargakuController::class, 'list']);
            });

            // Profile
            Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

            // Keuangan
            Route::prefix('keuangan')->group(function () {
                Route::get('/', [KeuanganController::class, 'index']);
                Route::post('/list', [KeuanganController::class, 'list']);
                Route::get('/create', [KeuanganController::class, 'create']);
                Route::post('/', [KeuanganController::class, 'store']);
            });
        });

        // Rute untuk pengguna dengan peran RT (role_id: 2)
        Route::prefix('rt')->middleware(['cek_login:2'])->group(function () {
            // Route::get('/', [WelcomeController::class, 'index'])->name('home');
            // Tambahkan rute khusus untuk pengguna RT di sini
        });

        // Rute untuk pengguna dengan peran lainnya (role_id: 3)
        Route::prefix('warga')->middleware(['cek_login:3'])->group(function () {
            Route::prefix('kegiatan')->group(function () {
                Route::get('/', [WargaKegiatanCOntroller::class, 'index']);
                Route::post('/list', [WargaKegiatanCOntroller::class, 'list']);
                Route::get('/{id}', [WargaKegiatanCOntroller::class, 'show']);
            });
            Route::prefix('dokumentasi')->group(function () {
                Route::get('/', [WargaDokumentasiController::class, 'index']);
                Route::post('/list', [WargaDokumentasiController::class, 'list']);
    
            });
    
            Route::prefix('keuangan')->group(function () {
                Route::get('/', [WargaKeuanganController::class, 'index']);
                Route::post('/list', [WargaKeuanganController::class, 'list']);
            });
    
            Route::prefix('keluargaku')->group(function () {
                Route::get('/', [WargaKeluargakuController::class, 'index']);
                Route::post('/list', [WargaKeluargakuController::class, 'list']);
            });

            Route::get('/profile', [WargaProfileController::class, 'show'])->name('profile.show');
        });

      
    });
});