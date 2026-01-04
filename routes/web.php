<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarCibiru1Controller;
use App\Http\Controllers\KamarCibiru2Controller;
use App\Http\Controllers\KamarRegol1Controller;
use App\Http\Controllers\KamarRegol2Controller;
use App\Http\Controllers\PenghuniCibiru1Controller;
use App\Http\Controllers\PenghuniCibiru2Controller;
use App\Http\Controllers\PenghuniRegol1Controller;
use App\Http\Controllers\PenghuniRegol2Controller;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Ubah route '/' agar langsung ke dashboard
Route::get('/', [DashboardController::class, 'index'])->name('home');

//kamar cibiru 1
Route::get('/kamar_cibiru1', [KamarCibiru1Controller::class, 'index'])->name('kamar_cibiru1.index');
Route::get('kamar_cibiru1/create', [KamarCibiru1Controller::class, 'create'])->name('kamar_cibiru1.create');
Route::post('kamar_cibiru1', [KamarCibiru1Controller::class, 'store'])->name('kamar_cibiru1.store');
Route::get('kamar_cibiru1/{id_kamar}/edit', [KamarCibiru1Controller::class, 'edit'])->name('kamar_cibiru1.edit');
Route::put('kamar_cibiru1/{id_kamar}', [KamarCibiru1Controller::class, 'update'])->name('kamar_cibiru1.update');
Route::delete('kamar_cibiru1/{id_kamar}', [KamarCibiru1Controller::class, 'destroy'])->name('kamar_cibiru1.destroy');

//kamar cibiru 2
Route::get('/kamar_cibiru2', [KamarCibiru2Controller::class, 'index'])->name('kamar_cibiru2.index');
Route::get('/kamar_cibiru2/create', [KamarCibiru2Controller::class, 'create'])->name('kamar_cibiru2.create');
Route::post('/kamar_cibiru2', [KamarCibiru2Controller::class, 'store'])->name('kamar_cibiru2.store');
Route::get('kamar_cibiru2/{id_kamar}/edit', [KamarCibiru2Controller::class, 'edit'])->name('kamar_cibiru2.edit');
Route::put('kamar_cibiru2/{id_kamar}', [KamarCibiru2Controller::class, 'update'])->name('kamar_cibiru2.update');
Route::delete('kamar_cibiru2/{id_kamar}', [KamarCibiru2Controller::class, 'destroy'])->name('kamar_cibiru2.destroy');

//kamar regol 1
Route::get('/kamar_regol1', [KamarRegol1Controller::class, 'index'])->name('kamar_regol1.index');
Route::get('/kamar_regol1/create', [KamarRegol1Controller::class, 'create'])->name('kamar_regol1.create');
Route::post('/kamar_regol1', [KamarRegol1Controller::class, 'store'])->name('kamar_regol1.store');
Route::get('/kamar_regol1/{id_kamar}/edit', [KamarRegol1Controller::class, 'edit'])->name('kamar_regol1.edit');
Route::put('/kamar_regol1/{id_kamar}', [KamarRegol1Controller::class, 'update'])->name('kamar_regol1.update');
Route::delete('/kamar_regol1/{id_kamar}', [KamarRegol1Controller::class, 'destroy'])->name('kamar_regol1.destroy');

//kamar regol 2
Route::get('/kamar_regol2', [KamarRegol2Controller::class, 'index'])->name('kamar_regol2.index');
Route::get('/kamar_regol2/create', [KamarRegol2Controller::class, 'create'])->name('kamar_regol2.create');
Route::post('/kamar_regol2', [KamarRegol2Controller::class, 'store'])->name('kamar_regol2.store');
Route::get('/kamar_regol2/{id_kamar}/edit', [KamarRegol2Controller::class, 'edit'])->name('kamar_regol2.edit');
Route::put('/kamar_regol2/{id_kamar}', [KamarRegol2Controller::class, 'update'])->name('kamar_regol2.update');
Route::delete('/kamar_regol2/{id_kamar}', [KamarRegol2Controller::class, 'destroy'])->name('kamar_regol2.destroy');

//penghuni cibiru 1
Route::get('/penghuni_cibiru1', [PenghuniCibiru1Controller::class, 'index'])->name('penghuni_cibiru1.index');
Route::get('/penghuni_cibiru1/create', [PenghuniCibiru1Controller::class, 'create'])->name('penghuni_cibiru1.create');
Route::post('/penghuni_cibiru1', [PenghuniCibiru1Controller::class, 'store'])->name('penghuni_cibiru1.store');
Route::get('/penghuni_cibiru1/{id_penghuni}/edit', [PenghuniCibiru1Controller::class, 'edit'])->name('penghuni_cibiru1.edit');
Route::put('/penghuni_cibiru1/{id_penghuni}', [PenghuniCibiru1Controller::class, 'update'])->name('penghuni_cibiru1.update');
Route::delete('/penghuni_cibiru1/{id_penghuni}', [PenghuniCibiru1Controller::class, 'destroy'])->name('penghuni_cibiru1.destroy');

//penghuni cibiru 2
Route::get('/penghuni_cibiru2', [PenghuniCibiru2Controller::class, 'index'])->name('penghuni_cibiru2.index');
Route::get('/penghuni_cibiru2/create', [PenghuniCibiru2Controller::class, 'create'])->name('penghuni_cibiru2.create');
Route::post('/penghuni_cibiru2', [PenghuniCibiru2Controller::class, 'store'])->name('penghuni_cibiru2.store');
Route::get('/penghuni_cibiru2/{id_penghuni}/edit', [PenghuniCibiru2Controller::class, 'edit'])->name('penghuni_cibiru2.edit');
Route::put('/penghuni_cibiru2/{id_penghuni}', [PenghuniCibiru2Controller::class, 'update'])->name('penghuni_cibiru2.update');
Route::delete('/penghuni_cibiru2/{id_penghuni}', [PenghuniCibiru2Controller::class, 'destroy'])->name('penghuni_cibiru2.destroy');

//penghuni regol 1
Route::get('/penghuni_regol1', [PenghuniRegol1Controller::class, 'index'])->name('penghuni_regol1.index');
Route::get('/penghuni_regol1/create', [PenghuniRegol1Controller::class, 'create'])->name('penghuni_regol1.create');
Route::post('/penghuni_regol1', [PenghuniRegol1Controller::class, 'store'])->name('penghuni_regol1.store');
Route::get('/penghuni_regol1/{id_penghuni}/edit', [PenghuniRegol1Controller::class, 'edit'])->name('penghuni_regol1.edit');
Route::put('/penghuni_regol1/{id_penghuni}', [PenghuniRegol1Controller::class, 'update'])->name('penghuni_regol1.update');
Route::delete('/penghuni_regol1/{id_penghuni}', [PenghuniRegol1Controller::class, 'destroy'])->name('penghuni_regol1.destroy');

//penghuni regol 2
Route::get('/penghuni_regol2', [PenghuniRegol2Controller::class, 'index'])->name('penghuni_regol2.index');
Route::get('/penghuni_regol2/create', [PenghuniRegol2Controller::class, 'create'])->name('penghuni_regol2.create');
Route::post('/penghuni_regol2', [PenghuniRegol2Controller::class, 'store'])->name('penghuni_regol2.store');
Route::get('/penghuni_regol2/{id_penghuni}/edit', [PenghuniRegol2Controller::class, 'edit'])->name('penghuni_regol2.edit');
Route::put('/penghuni_regol2/{id_penghuni}', [PenghuniRegol2Controller::class, 'update'])->name('penghuni_regol2.update');
Route::delete('/penghuni_regol2/{id_penghuni}', [PenghuniRegol2Controller::class, 'destroy'])->name('penghuni_regol2.destroy');