<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\rw\KegiatanController;
use App\Http\Controllers\rw\KeluargaController;
use App\Http\Controllers\rw\WargaController;
use App\Http\Controllers\rw\KepemilikanController;
use App\Http\Controllers\rw\DokumentasiController;
use App\Http\Controllers\rw\IuranController;
use App\Http\Controllers\rw\SPKController;
use App\Http\Controllers\rw\KeluargakuController;
use App\Http\Controllers\rw\KeuanganController;
use App\Http\Controllers\rw\ProfileController;
use App\Http\Controllers\rw\PersetujuanController;

use App\Http\Controllers\rt\RTKegiatanController;
use App\Http\Controllers\rt\RTKeluargaController;
use App\Http\Controllers\rt\RTWargaController;
use App\Http\Controllers\rt\RTKepemilikanController;
use App\Http\Controllers\rt\RTDokumentasiController;
use App\Http\Controllers\rt\RTIuranController;
use App\Http\Controllers\rt\RTSPKController;
use App\Http\Controllers\rt\RTKeluargakuController;
use App\Http\Controllers\rt\RTKeuanganController;
use App\Http\Controllers\rt\RTProfileController;

use App\Http\Controllers\warga\WargaKegiatanCOntroller;
use App\Http\Controllers\warga\WargaDokumentasiController;
use App\Http\Controllers\warga\WargaKeuanganController;
use App\Http\Controllers\warga\WargaKeluargakuController;
use App\Http\Controllers\warga\WargaProfileController;
use App\Http\Controllers\warga\WargaIuranController;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('prevent-back-history')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [WelcomeController::class, 'index'])->name('home');
        Route::get('/ubah-password', [ResetPasswordController::class, 'showChangePasswordForm'])->name('ubah-password');
        Route::post('/ubah-password', [ResetPasswordController::class, 'changePassword']);
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
                Route::get('/', [KeluargakuController::class, 'index'])->name('keluargaku.index');
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

            Route::prefix('iuran')->group(function () {
                Route::get('/', [IuranController::class, 'index']);
                Route::post('/list', [IuranController::class, 'list']);
                Route::post('/listSaya', [IuranController::class, 'listSaya']);
                Route::get('/{id}/bayar', [IuranController::class, 'bayar']);
                Route::put('/{id}', [IuranController::class, 'buktiPembayaran']);
                Route::get('/{id}', [IuranController::class, 'show']);
            });

            Route::prefix('persetujuan')->group(function () {
                Route::get('/', [PersetujuanController::class, 'index']);
                Route::post('/list', [PersetujuanController::class, 'list']);
                Route::get('/{id}/iuran', [PersetujuanController::class, 'periksaIuran']);
                Route::get('/{id}/data kepemilikan', [PersetujuanController::class, 'periksaDataKepemilikan']);
                Route::get('/{id}/kegiatan', [PersetujuanController::class, 'periksaKegiatan']);
                Route::put('/{id}/keputusan', [PersetujuanController::class, 'keputusan']);
            });
        });

        // Rute untuk pengguna dengan peran RT (role_id: 2)
        Route::prefix('rt')->middleware(['cek_login:2'])->group(function () {
            Route::prefix('warga')->group(function () {
                Route::get('/', [RTWargaController::class, 'index']);
                Route::post('/list', [RTWargaController::class, 'list']);
                Route::get('/create', [RTWargaController::class, 'create']);
                Route::post('/', [RTWargaController::class, 'store']);
                Route::get('/{id}', [RTWargaController::class, 'show']);
                Route::get('/{id}/edit', [RTWargaController::class, 'edit']);
                Route::put('/{id}', [RTWargaController::class, 'update']);
            });

            // Kegiatan
            Route::prefix('kegiatan')->group(function () {
                Route::get('/', [RTKegiatanController::class, 'index']);
                Route::post('/list', [RTKegiatanController::class, 'list']);
                Route::get('/create', [RTKegiatanController::class, 'create']);
                Route::post('/', [RTKegiatanController::class, 'store']);
                Route::get('/{id}', [RTKegiatanController::class, 'show']);
               
            });

            // Dokumentasi
            Route::prefix('dokumentasi')->group(function () {
                Route::get('/', [RTDokumentasiController::class, 'index']);
                Route::post('/list', [RTDokumentasiController::class, 'list']);
                Route::get('/create', [RTDokumentasiController::class, 'create']);
                Route::post('/', [RTDokumentasiController::class, 'store']);
                Route::get('/{id}/edit', [RTDokumentasiController::class, 'edit']);
                Route::put('/{id}', [RTDokumentasiController::class, 'update']);
            });

            // Kepemilikan
            Route::prefix('kepemilikan')->group(function () {
                Route::get('/', [RTKepemilikanController::class, 'index']);
                Route::post('/list', [RTKepemilikanController::class, 'list']);
                Route::get('/create', [RTKepemilikanController::class, 'create']);
                Route::post('/', [RTKepemilikanController::class, 'store']);
                Route::get('/{id}', [RTKepemilikanController::class, 'show']);
                Route::get('/{id}/edit', [RTKepemilikanController::class, 'edit']);
                Route::put('/{id}', [RTKepemilikanController::class, 'update']);
            });

            // Keluarga
            Route::prefix('keluarga')->group(function () {
                Route::get('/', [RTKeluargaController::class, 'index']);
                Route::post('/list', [RTKeluargaController::class, 'list']);
                Route::get('/create', [RTKeluargaController::class, 'create']);
                Route::post('/', [RTKeluargaController::class, 'store']);
                Route::get('/{id}/edit', [RTKeluargaController::class, 'edit']);
                Route::get('/{id}', [RTKeluargaController::class, 'show']);
                Route::put('/{id}', [RTKeluargaController::class, 'update']);
            });


            // Keluargaku
            Route::prefix('keluargaku')->group(function () {
                Route::get('/', [RTKeluargakuController::class, 'index']);
                Route::post('/list', [RTKeluargakuController::class, 'list']);
            });

            // Profile
            Route::get('/profile', [RTProfileController::class, 'show'])->name('profile.show');

            // Keuangan
            Route::prefix('keuangan')->group(function () {
                Route::get('/', [RTKeuanganController::class, 'index']);
                Route::post('/list', [RTKeuanganController::class, 'list']);
   
            });

            Route::prefix('iuran')->group(function () {
                Route::get('/', [RTIuranController::class, 'index']);
                Route::post('/list', [RTIuranController::class, 'list']);
                Route::post('/listSaya', [RTIuranController::class, 'listSaya']);
                Route::get('/{id}/bayar', [RTIuranController::class, 'bayar']);
                Route::put('/{id}', [RTIuranController::class, 'buktiPembayaran']);
                Route::get('/{id}', [RTIuranController::class, 'show']);
            });

        
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

            Route::prefix('iuran')->group(function () {
                Route::get('/', [WargaIuranController::class, 'index']);
                Route::post('/listSaya', [WargaIuranController::class, 'listSaya']);
                Route::get('/{id}/bayar', [WargaIuranController::class, 'bayar']);
                Route::put('/{id}', [WargaIuranController::class, 'buktiPembayaran']);
                Route::get('/{id}', [WargaIuranController::class, 'show']);
            });
        });

      
    });
});

Route::fallback(function () {
    return redirect()->route('home');
});