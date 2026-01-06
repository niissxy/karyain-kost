<?php

use App\Http\Controllers\AsetCibiru1Controller;
use App\Http\Controllers\AsetCibiru2Controller;
use App\Http\Controllers\AsetRegol1Controller;
use App\Http\Controllers\AsetRegol2Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FasKamarCibiru1Controller;
use App\Http\Controllers\FasKamarCibiru2Controller;
use App\Http\Controllers\FasKamarRegol1Controller;
use App\Http\Controllers\FasKamarRegol2Controller;
use App\Http\Controllers\FasumCibiru1Controller;
use App\Http\Controllers\FasumCibiru2Controller;
use App\Http\Controllers\FasumRegol1Controller;
use App\Http\Controllers\FasumRegol2Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarCibiru1Controller;
use App\Http\Controllers\KamarCibiru2Controller;
use App\Http\Controllers\KamarRegol1Controller;
use App\Http\Controllers\KamarRegol2Controller;
use App\Http\Controllers\LapKamarCibiru1Controller;
use App\Http\Controllers\LapKamarCibiru2Controller;
use App\Http\Controllers\LapKamarRegol1Controller;
use App\Http\Controllers\LapKamarRegol2Controller;
use App\Http\Controllers\LapTransaksiCibiru1Controller;
use App\Http\Controllers\LapTransaksiCibiru2Controller;
use App\Http\Controllers\LapTransaksiRegol1Controller;
use App\Http\Controllers\LapTransaksiRegol2Controller;
use App\Http\Controllers\LapPenghuniCibiru1Controller;
use App\Http\Controllers\LapPenghuniCibiru2Controller;
use App\Http\Controllers\LapPenghuniRegol1Controller;
use App\Http\Controllers\LapPenghuniRegol2Controller;
use App\Http\Controllers\PenghuniCibiru1Controller;
use App\Http\Controllers\PenghuniCibiru2Controller;
use App\Http\Controllers\PenghuniRegol1Controller;
use App\Http\Controllers\PenghuniRegol2Controller;
use App\Http\Controllers\SewaCibiru1Controller;
use App\Http\Controllers\SewaCibiru2Controller;
use App\Http\Controllers\SewaRegol1Controller;
use App\Http\Controllers\SewaRegol2Controller;

use App\Http\Controllers\TransaksiCibiru1Controller;
use App\Http\Controllers\TransaksiCibiru2Controller;
use App\Http\Controllers\TransaksiRegol1Controller;
use App\Http\Controllers\TransaksiRegol2Controller;

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

//laporan transaksi cibiru 1
Route::get('/laptransaksi_cibiru1', [LapTransaksiCibiru1Controller::class, 'index'])->name('laptransaksi_cibiru1.index');
Route::get('/laptransaksi_cibiru1/create', [LapTransaksiCibiru1Controller::class, 'create'])->name('laptransaksi_cibiru1.create');
Route::post('/laptransaksi_cibiru1', [LapTransaksiCibiru1Controller::class, 'store'])->name('laptransaksi_cibiru1.store');

//laporan transaksi cibiru 2
Route::get('/laptransaksi_cibiru2', [LapTransaksiCibiru2Controller::class, 'index'])->name('laptransaksi_cibiru2.index');
Route::get('/laptransaksi_cibiru2/create', [LapTransaksiCibiru2Controller::class, 'create'])->name('laptransaksi_cibiru2.create');
Route::post('/laptransaksi_cibiru2', [LapTransaksiCibiru2Controller::class, 'store'])->name('laptransaksi_cibiru2.store');

//laporan transaksi regol 1
Route::get('/laptransaksi_regol1', [LapTransaksiRegol1Controller::class, 'index'])->name('laptransaksi_regol1.index');
Route::get('/laptransaksi_regol1/create', [LapTransaksiRegol1Controller::class, 'create'])->name('laptransaksi_regol1.create');
Route::post('/laptransaksi_regol1', [LapTransaksiRegol1Controller::class, 'store'])->name('laptransaksi_regol1.store');

//laporan transaksi regol 1
Route::get('/laptransaksi_regol2', [LapTransaksiRegol2Controller::class, 'index'])->name('laptransaksi_regol2.index');
Route::get('/laptransaksi_regol2/create', [LapTransaksiRegol2Controller::class, 'create'])->name('laptransaksi_regol2.create');
Route::post('/laptransaksi_regol2', [LapTransaksiRegol2Controller::class, 'store'])->name('laptransaksi_regol2.store');

//laporan penghuni cibiru 1
Route::get('/lappenghuni_cibiru1', [LapPenghuniCibiru1Controller::class, 'index'])->name('lappenghuni_cibiru1.index');
Route::get('/lappenghuni_cibiru1/create', [LapPenghuniCibiru1Controller::class, 'create'])->name('lappenghuni_cibiru1.create');
Route::post('/lappenghuni_cibiru1',[LapPenghuniCibiru1Controller::class, 'store'])->name('lappenghuni_cibiru1.store');

//laporan penghuni cibiru 2
Route::get('/lappenghuni_cibiru2', [LapPenghuniCibiru2Controller::class, 'index'])->name('lappenghuni_cibiru2.index');
Route::get('/lappenghuni_cibiru2/create', [LapPenghuniCibiru2Controller::class, 'create'])->name('lappenghuni_cibiru2.create');
Route::post('/lappenghuni_cibiru2',[LapPenghuniCibiru2Controller::class, 'store'])->name('lappenghuni_cibiru2.store');

//laporan penghuni regol 1
Route::get('/lappenghuni_regol1', [LapPenghuniRegol1Controller::class, 'index'])->name('lappenghuni_regol1.index');
Route::get('/lappenghuni_regol1/create', [LapPenghuniRegol1Controller::class, 'create'])->name('lappenghuni_regol1.create');
Route::post('/lappenghuni_regol1',[LapPenghuniRegol1Controller::class, 'store'])->name('lappenghuni_regol1.store');

//laporan penghuni regol 1
Route::get('/lappenghuni_regol2', [LapPenghuniRegol2Controller::class, 'index'])->name('lappenghuni_regol2.index');
Route::get('/lappenghuni_regol2/create', [LapPenghuniRegol2Controller::class, 'create'])->name('lappenghuni_regol2.create');
Route::post('/lappenghuni_regol2',[LapPenghuniRegol2Controller::class, 'store'])->name('lappenghuni_regol2.store');


//laporan kamar cibiru 1
Route::get('/lapkamar_cibiru1', [LapKamarCibiru1Controller::class, 'index'])->name('lapkamar_cibiru1.index');
Route::get('/lapkamar_cibiru1/create', [LapKamarCibiru1Controller::class, 'create'])->name('lapkamar_cibiru1.create');
Route::post('/lapkamar_cibiru1',[LapKamarCibiru1Controller::class, 'store'])->name('lapkamar_cibiru1.store');

//laporan kamar cibiru 2
Route::get('/lapkamar_cibiru2', [LapKamarCibiru2Controller::class, 'index'])->name('lapkamar_cibiru2.index');
Route::get('/lapkamar_cibiru2/create', [LapKamarCibiru2Controller::class, 'create'])->name('lapkamar_cibiru2.create');
Route::post('/lapkamar_cibiru2',[LapKamarCibiru2Controller::class, 'store'])->name('lapkamar_cibiru2.store');

//laporan kamar regol 1
Route::get('/lapkamar_regol1', [LapKamarRegol1Controller::class, 'index'])->name('lapkamar_regol1.index');
Route::get('/lapkamar_regol1/create', [LapKamarRegol1Controller::class, 'create'])->name('lapkamar_regol1.create');
Route::post('/lapkamar_regol1',[LapKamarRegol1Controller::class, 'store'])->name('lapkamar_regol1.store');

//laporan kamar regol 2
Route::get('/lapkamar_regol2', [LapKamarRegol2Controller::class, 'index'])->name('lapkamar_regol2.index');
Route::get('/lapkamar_regol2/create', [LapKamarRegol2Controller::class, 'create'])->name('lapkamar_regol2.create');
Route::post('/lapkamar_regol2',[LapKamarRegol2Controller::class, 'store'])->name('lapkamar_regol2.store');

//aset cibiru 1
Route::get('/aset_cibiru1', [AsetCibiru1Controller::class, 'index'])->name('aset_cibiru1.index');
Route::get('/aset_cibiru1/create', [AsetCibiru1Controller::class, 'create'])->name('aset_cibiru1.create');
Route::post('/aset_cibiru1', [AsetCibiru1Controller::class, 'store'])->name('aset_cibiru1.store');
Route::get('/aset_cibiru1/{id_aset}/edit', [AsetCibiru1Controller::class, 'edit'])->name('aset_cibiru1.edit');
Route::put('/aset_cibiru1/{id_aset}', [AsetCibiru1Controller::class, 'update'])->name('aset_cibiru1.update');
Route::delete('/aset_cibiru1/{id_aset}', [AsetCibiru1Controller::class, 'destroy'])->name('aset_cibiru1.destroy');

//aset cibiru 2
Route::get('/aset_cibiru2', [AsetCibiru2Controller::class, 'index'])->name('aset_cibiru2.index');
Route::get('/aset_cibiru2/create', [AsetCibiru2Controller::class, 'create'])->name('aset_cibiru2.create');
Route::post('/aset_cibiru2', [AsetCibiru2Controller::class, 'store'])->name('aset_cibiru2.store');
Route::get('/aset_cibiru2/{id_aset}/edit', [AsetCibiru2Controller::class, 'edit'])->name('aset_cibiru2.edit');
Route::put('/aset_cibiru2/{id_aset}', [AsetCibiru2Controller::class, 'update'])->name('aset_cibiru2.update');
Route::delete('/aset_cibiru2/{id_aset}', [AsetCibiru2Controller::class, 'destroy'])->name('aset_cibiru2.destroy');

//aset regol 1
Route::get('/aset_regol1', [AsetRegol1Controller::class, 'index'])->name('aset_regol1.index');
Route::get('/aset_regol1/create', [AsetRegol1Controller::class, 'create'])->name('aset_regol1.create');
Route::post('/aset_regol1', [AsetRegol1Controller::class, 'store'])->name('aset_regol1.store');
Route::get('/aset_regol1/{id_aset}/edit', [AsetRegol1Controller::class, 'edit'])->name('aset_regol1.edit');
Route::put('/aset_regol1/{id_aset}', [AsetRegol1Controller::class, 'update'])->name('aset_regol1.update');
Route::delete('/aset_regol1/{id_aset}', [AsetRegol1Controller::class, 'destroy'])->name('aset_regol1.destroy');

//aset regol 2
Route::get('/aset_regol2', [AsetRegol2Controller::class, 'index'])->name('aset_regol2.index');
Route::get('/aset_regol2/create', [AsetRegol2Controller::class, 'create'])->name('aset_regol2.create');
Route::post('/aset_regol2', [AsetRegol2Controller::class, 'store'])->name('aset_regol2.store');
Route::get('/aset_regol2/{id_aset}/edit', [AsetRegol2Controller::class, 'edit'])->name('aset_regol2.edit');
Route::put('/aset_regol2/{id_aset}', [AsetRegol2Controller::class, 'update'])->name('aset_regol2.update');
Route::delete('/aset_regol2/{id_aset}', [AsetRegol2Controller::class, 'destroy'])->name('aset_regol2.destroy');

//fasilitas kamar cibiru 1
Route::get('/faskamar_cibiru1', [FasKamarCibiru1Controller::class, 'index'])->name('faskamar_cibiru1.index');
Route::get('/faskamar_cibiru1/create', [FasKamarCibiru1Controller::class, 'create'])->name('faskamar_cibiru1.create');
Route::post('/faskamar_cibiru1', [FasKamarCibiru1Controller::class, 'store'])->name('faskamar_cibiru1.store');
Route::get('/faskamar_cibiru1/{id_fask}/edit', [FasKamarCibiru1Controller::class, 'edit'])->name('faskamar_cibiru1.edit');
Route::put('/faskamar_cibiru1/{id_fask}', [FasKamarCibiru1Controller::class, 'update'])->name('faskamar_cibiru1.update');
Route::delete('/faskamar_cibiru1/{id_fask}', [FasKamarCibiru1Controller::class, 'destroy'])->name('faskamar_cibiru1.destroy');

//fasilitas kamar cibiru 2
Route::get('/faskamar_cibiru2', [FasKamarCibiru2Controller::class, 'index'])->name('faskamar_cibiru2.index');
Route::get('/faskamar_cibiru2/create', [FasKamarCibiru2Controller::class, 'create'])->name('faskamar_cibiru2.create');
Route::post('/faskamar_cibiru2', [FasKamarCibiru2Controller::class, 'store'])->name('faskamar_cibiru2.store');
Route::get('/faskamar_cibiru2/{id_fask}/edit', [FasKamarCibiru2Controller::class, 'edit'])->name('faskamar_cibiru2.edit');
Route::put('/faskamar_cibiru2/{id_fask}', [FasKamarCibiru2Controller::class, 'update'])->name('faskamar_cibiru2.update');
Route::delete('/faskamar_cibiru2/{id_fask}', [FasKamarCibiru2Controller::class, 'destroy'])->name('faskamar_cibiru2.destroy');

//fasilitas kamar regol 1
Route::get('/faskamar_regol1', [FasKamarRegol1Controller::class, 'index'])->name('faskamar_regol1.index');
Route::get('/faskamar_regol1/create', [FasKamarRegol1Controller::class, 'create'])->name('faskamar_regol1.create');
Route::post('/faskamar_regol1', [FasKamarRegol1Controller::class, 'store'])->name('faskamar_regol1.store');
Route::get('/faskamar_regol1/{id_fask}/edit', [FasKamarRegol1Controller::class, 'edit'])->name('faskamar_regol1.edit');
Route::put('/faskamar_regol1/{id_fask}', [FasKamarRegol1Controller::class, 'update'])->name('faskamar_regol1.update');
Route::delete('/faskamar_regol1/{id_fask}', [FasKamarRegol1Controller::class, 'destroy'])->name('faskamar_regol1.destroy');

//fasilitas kamar regol 2
Route::get('/faskamar_regol2', [FasKamarRegol2Controller::class, 'index'])->name('faskamar_regol2.index');
Route::get('/faskamar_regol2/create', [FasKamarRegol2Controller::class, 'create'])->name('faskamar_regol2.create');
Route::post('/faskamar_regol2', [FasKamarRegol2Controller::class, 'store'])->name('faskamar_regol2.store');
Route::get('/faskamar_regol2/{id_fask}/edit', [FasKamarRegol2Controller::class, 'edit'])->name('faskamar_regol2.edit');
Route::put('/faskamar_regol2/{id_fask}', [FasKamarRegol2Controller::class, 'update'])->name('faskamar_regol2.update');
Route::delete('/faskamar_regol2/{id_fask}', [FasKamarRegol2Controller::class, 'destroy'])->name('faskamar_regol2.destroy');

//fasilitas umum cibiru 1
Route::get('/fasum_cibiru1', [FasumCibiru1Controller::class, 'index'])->name('fasum_cibiru1.index');
Route::get('/fasum_cibiru1/create', [FasumCibiru1Controller::class, 'create'])->name('fasum_cibiru1.create');
Route::post('/fasum_cibiru1', [FasumCibiru1Controller::class, 'store'])->name('fasum_cibiru1.store');
Route::get('/fasum_cibiru1/{id_fask}/edit', [FasumCibiru1Controller::class, 'edit'])->name('fasum_cibiru1.edit');
Route::put('/fasum_cibiru1/{id_fask}', [FasumCibiru1Controller::class, 'update'])->name('fasum_cibiru1.update');
Route::delete('/fasum_cibiru1/{id_fask}', [FasumCibiru1Controller::class, 'destroy'])->name('fasum_cibiru1.destroy');

//fasilitas umum cibiru 2
Route::get('/fasum_cibiru2', [FasumCibiru2Controller::class, 'index'])->name('fasum_cibiru2.index');
Route::get('/fasum_cibiru2/create', [FasumCibiru2Controller::class, 'create'])->name('fasum_cibiru2.create');
Route::post('/fasum_cibiru2', [FasumCibiru2Controller::class, 'store'])->name('fasum_cibiru2.store');
Route::get('/fasum_cibiru2/{id_fask}/edit', [FasumCibiru2Controller::class, 'edit'])->name('fasum_cibiru2.edit');
Route::put('/fasum_cibiru2/{id_fask}', [FasumCibiru2Controller::class, 'update'])->name('fasum_cibiru2.update');
Route::delete('/fasum_cibiru2/{id_fask}', [FasumCibiru2Controller::class, 'destroy'])->name('fasum_cibiru2.destroy');

//fasilitas umum regol 1
Route::get('/fasum_regol1', [FasumRegol1Controller::class, 'index'])->name('fasum_regol1.index');
Route::get('/fasum_regol1/create', [FasumRegol1Controller::class, 'create'])->name('fasum_regol1.create');
Route::post('/fasum_regol1', [FasumRegol1Controller::class, 'store'])->name('fasum_regol1.store');
Route::get('/fasum_regol1/{id_fask}/edit', [FasumRegol1Controller::class, 'edit'])->name('fasum_regol1.edit');
Route::put('/fasum_regol1/{id_fask}', [FasumRegol1Controller::class, 'update'])->name('fasum_regol1.update');
Route::delete('/fasum_regol1/{id_fask}', [FasumRegol1Controller::class, 'destroy'])->name('fasum_regol1.destroy');

//fasilitas umum regol 2
Route::get('/fasum_regol2', [FasumRegol2Controller::class, 'index'])->name('fasum_regol2.index');
Route::get('/fasum_regol2/create', [FasumRegol2Controller::class, 'create'])->name('fasum_regol2.create');
Route::post('/fasum_regol2', [FasumRegol2Controller::class, 'store'])->name('fasum_regol2.store');
Route::get('/fasum_regol2/{id_fask}/edit', [FasumRegol2Controller::class, 'edit'])->name('fasum_regol2.edit');
Route::put('/fasum_regol2/{id_fask}', [FasumRegol2Controller::class, 'update'])->name('fasum_regol2.update');
Route::delete('/fasum_regol2/{id_fask}', [FasumRegol2Controller::class, 'destroy'])->name('fasum_regol2.destroy');

//transaksi cibiru 1
Route::get('/transaksi_cibiru1', [TransaksiCibiru1Controller::class, 'index'])->name('transaksi_cibiru1.index');
Route::get('/transaksi_cibiru1/create', [TransaksiCibiru1Controller::class, 'create'])->name('transaksi_cibiru1.create');
Route::post('/transaksi_cibiru1', [TransaksiCibiru1Controller::class, 'store'])->name('transaksi_cibiru1.store');
Route::get('/transaksi_cibiru1/{id_transaksi}/edit', [TransaksiCibiru1Controller::class, 'edit'])->name('transaksi_cibiru1.edit');
Route::put('/transaksi_cibiru1/{id_transaksi}', [TransaksiCibiru1Controller::class, 'update'])->name('transaksi_cibiru1.update');
Route::delete('/transaksi_cibiru1/{id_transaksi}', [TransaksiCibiru1Controller::class, 'destroy'])->name('transaksi_cibiru1.destroy');

//transaksi cibiru 2
Route::get('/transaksi_cibiru2', [TransaksiCibiru2Controller::class, 'index'])->name('transaksi_cibiru2.index');
Route::get('/transaksi_cibiru2/create', [TransaksiCibiru2Controller::class, 'create'])->name('transaksi_cibiru2.create');
Route::post('/transaksi_cibiru2', [TransaksiCibiru2Controller::class, 'store'])->name('transaksi_cibiru2.store');
Route::get('/transaksi_cibiru2/{id_transaksi}/edit', [TransaksiCibiru2Controller::class, 'edit'])->name('transaksi_cibiru2.edit');
Route::put('/transaksi_cibiru2/{id_transaksi}', [TransaksiCibiru2Controller::class, 'update'])->name('transaksi_cibiru2.update');
Route::delete('/transaksi_cibiru2/{id_transaksi}', [TransaksiCibiru2Controller::class, 'destroy'])->name('transaksi_cibiru2.destroy');

//transaksi regol 1
Route::get('/transaksi_regol1', [TransaksiRegol1Controller::class, 'index'])->name('transaksi_regol1.index');
Route::get('/transaksi_regol1/create', [TransaksiRegol1Controller::class, 'create'])->name('transaksi_regol1.create');
Route::post('/transaksi_regol1', [TransaksiRegol1Controller::class, 'store'])->name('transaksi_regol1.store');
Route::get('/transaksi_regol1/{id_transaksi}/edit', [TransaksiRegol1Controller::class, 'edit'])->name('transaksi_regol1.edit');
Route::put('/transaksi_regol1/{id_transaksi}', [TransaksiRegol1Controller::class, 'update'])->name('transaksi_regol1.update');
Route::delete('/transaksi_regol1/{id_transaksi}', [TransaksiRegol1Controller::class, 'destroy'])->name('transaksi_regol1.destroy');

//transaksi regol 2
Route::get('/transaksi_regol2', [TransaksiRegol2Controller::class, 'index'])->name('transaksi_regol2.index');
Route::get('/transaksi_regol2/create', [TransaksiRegol2Controller::class, 'create'])->name('transaksi_regol2.create');
Route::post('/transaksi_regol2', [TransaksiRegol2Controller::class, 'store'])->name('transaksi_regol2.store');
Route::get('/transaksi_regol2/{id_transaksi}/edit', [TransaksiRegol2Controller::class, 'edit'])->name('transaksi_regol2.edit');
Route::put('/transaksi_regol2/{id_transaksi}', [TransaksiRegol2Controller::class, 'update'])->name('transaksi_regol2.update');
Route::delete('/transaksi_regol2/{id_transaksi}', [TransaksiRegol2Controller::class, 'destroy'])->name('transaksi_regol2.destroy');

//sewa cibiru 1
Route::get('/sewa_cibiru1', [SewaCibiru1Controller::class, 'index'])->name('sewa_cibiru1.index');
Route::get('/sewa_cibiru1/create', [SewaCibiru1Controller::class, 'create'])->name('sewa_cibiru1.create');
Route::post('/sewa_cibiru1', [SewaCibiru1Controller::class, 'store'])->name('sewa_cibiru1.store');
Route::get('/sewa_cibiru1/{id_sewa}/edit', [SewaCibiru1Controller::class, 'edit'])->name('sewa_cibiru1.edit');
Route::put('/sewa_cibiru1/{id_sewa}', [SewaCibiru1Controller::class, 'update'])->name('sewa_cibiru1.update');
Route::delete('/sewa_cibiru1/{id_sewa}', [SewaCibiru1Controller::class, 'destroy'])->name('sewa_cibiru1.destroy');

//sewa cibiru 2
Route::get('/sewa_cibiru2', [SewaCibiru2Controller::class, 'index'])->name('sewa_cibiru2.index');
Route::get('/sewa_cibiru2/create', [SewaCibiru2Controller::class, 'create'])->name('sewa_cibiru2.create');
Route::post('/sewa_cibiru2', [SewaCibiru2Controller::class, 'store'])->name('sewa_cibiru2.store');
Route::get('/sewa_cibiru2/{id_sewa}/edit', [SewaCibiru2Controller::class, 'edit'])->name('sewa_cibiru2.edit');
Route::put('/sewa_cibiru2/{id_sewa}', [SewaCibiru2Controller::class, 'update'])->name('sewa_cibiru2.update');
Route::delete('/sewa_cibiru2/{id_sewa}', [SewaCibiru2Controller::class, 'destroy'])->name('sewa_cibiru2.destroy');

//sewa regol 1
Route::get('/sewa_regol1', [SewaRegol1Controller::class, 'index'])->name('sewa_regol1.index');
Route::get('/sewa_regol1/create', [SewaRegol1Controller::class, 'create'])->name('sewa_regol1.create');
Route::post('/sewa_regol1', [SewaRegol1Controller::class, 'store'])->name('sewa_regol1.store');
Route::get('/sewa_regol1/{id_sewa}/edit', [SewaRegol1Controller::class, 'edit'])->name('sewa_regol1.edit');
Route::put('/sewa_regol1/{id_sewa}', [SewaRegol1Controller::class, 'update'])->name('sewa_regol1.update');
Route::delete('/sewa_regol1/{id_sewa}', [SewaRegol1Controller::class, 'destroy'])->name('sewa_regol1.destroy');

//sewa regol 2
Route::get('/sewa_regol2', [SewaRegol2Controller::class, 'index'])->name('sewa_regol2.index');
Route::get('/sewa_regol2/create', [SewaRegol2Controller::class, 'create'])->name('sewa_regol2.create');
Route::post('/sewa_regol2', [SewaRegol2Controller::class, 'store'])->name('sewa_regol2.store');
Route::get('/sewa_regol2/{id_sewa}/edit', [SewaRegol2Controller::class, 'edit'])->name('sewa_regol2.edit');
Route::put('/sewa_regol2/{id_sewa}', [SewaRegol2Controller::class, 'update'])->name('sewa_regol2.update');
Route::delete('/sewa_regol2/{id_sewa}', [SewaRegol2Controller::class, 'destroy'])->name('sewa_regol2.destroy');