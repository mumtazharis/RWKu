<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WargaController;


Route::get('/', function () {
    return view('welcome');
});
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


