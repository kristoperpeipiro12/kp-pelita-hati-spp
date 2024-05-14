<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('layout.main');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {
route::get('/dashboard', [HomeController::class,'index'])->name('admin.dashboard');

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{nis}', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{nis}', [SiswaController::class, 'delete'])->name('siswa.delete');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('Informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('Informasi/create', [InformasiController::class, 'create'])->name('informasi.create');
Route::post('Informasi/store', [InformasiController::class, 'store'])->name('informasi.store');
Route::get('Informasi/{id}', [InformasiController::class, 'edit'])->name('informasi.edit');
Route::put('Informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');
Route::delete('Informasi/{id}', [InformasiController::class, 'delete'])->name('informasi.delete');

Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
Route::get('/tagihan/create', [TagihanController::class, 'create'])->name('tagihan.create');
Route::post('/tagihan/store', [TagihanController::class, 'store'])->name('tagihan.store');
Route::get('/tagihan/edit/{id}', [TagihanController::class, 'edit'])->name('tagihan.edit');
Route::put('/tagihan/update/{id}', [TagihanController::class, 'update'])->name('tagihan.update');
Route::delete('/tagihan/delete/{id}', [TagihanController::class, 'delete'])->name('tagihan.delete');

Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
Route::post('/pemasukan/store', [PemasukanController::class, 'store'])->name('pemasukan.store');
Route::get('/pemasukan/{id}', [PemasukanController::class, 'edit'])->name('pemasukan.edit');
Route::put('/pemasukan/{id}', [PemasukanController::class, 'update'])->name('pemasukan.update');
Route::delete('/pemasukan/{id}', [PemasukanController::class, 'delete'])->name('pemasukan.delete');
// Route::get('/getSiswaNis', [PemasukanController::class, 'getSiswaNis']);

Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
Route::get('/pengeluaran/edt', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
Route::post('/pengeluaran/update', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::delete('/pengeluaran/delete', [PengeluaranController::class, 'delete'])->name('pengeluaran.delete');
});


Route::group(['prefix' => 'siswa', 'middleware' => 'auth:siswa'], function () {
    Route::get('/dashboard',[HomeController::class, 'siswa'])->name('dashboard.siswa');
});

Route::group(['prefix' => 'yayasan', 'middleware' => 'auth:yayasan'], function () {
    Route::get('/dashboard',[HomeController::class, 'yayasan'])->name('yayasan.dashboard');
});