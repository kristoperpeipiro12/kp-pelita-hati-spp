<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PemasukanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Siswa\HomeController as SiswaHomeController;
use App\Http\Controllers\Siswa\TagihanController as SiswaTagihanController;
use App\Http\Controllers\Yayasan\HomeController as YayasanHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:web', 'role:admin']], function () {
    Route::get('', [HomeController::class, 'admin'])->name('admin');
    Route::get('/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');

    Route::get('/chart/get-total-pemasukan-pengeluaran', [HomeController::class, 'getTotalPemasukanPengeluaran']);

    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/naik-kelas', [SiswaController::class, 'naik_kelas'])->name('admin.siswa.naikkelas');
    Route::post('/siswa/naik-Semua', [SiswaController::class, 'naikSemua'])->name('admin.siswa.naiksemua');
    Route::post('/siswa/naik-Singel', [SiswaController::class, 'naikSingel'])->name('admin.siswa.naiksatu');
    Route::get('/siswa/lulus', [SiswaController::class, 'siswaLulus'])->name('admin.siswa.lulus');
    Route::delete('/siswa/hapus', [SiswaController::class, 'hapusSemua'])->name('admin.siswa.hapus');
    Route::delete('/siswa/hapus-lulus/{nis}', [SiswaController::class, 'hapusSiswaLulus'])->name('admin.siswa.hapus-lulus-nis');
    Route::get('/siswa/{nis}', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{nis}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/{nis}', [SiswaController::class, 'delete'])->name('admin.siswa.delete');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
    Route::put('/informasi/create', [InformasiController::class, 'create'])->name('informasi.create');
    Route::put('/informasi/update/{id}', [InformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/informasi/{id}', [InformasiController::class, 'delete'])->name('informasi.delete');

    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
    Route::post('/tagihan/store', [TagihanController::class, 'store'])->name('tagihan.store');
    Route::put('/tagihan/update/{kelas}', [TagihanController::class, 'update'])->name('tagihan.update');
    Route::delete('/tagihan/delete/{kelas}', [TagihanController::class, 'delete'])->name('tagihan.delete');

    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
    Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
    Route::post('/pemasukan/store', [PemasukanController::class, 'store'])->name('pemasukan.store');
    Route::get('/pemasukan/{id}', [PemasukanController::class, 'edit'])->name('pemasukan.edit');
    Route::put('/pemasukan/{id}', [PemasukanController::class, 'update'])->name('pemasukan.update');
    Route::put('/pemasukan/konfirmasi/{id}', [PemasukanController::class, 'konfirmasi'])->name('pemasukan.konfirmasi');
    Route::delete('/pemasukan/{id}', [PemasukanController::class, 'delete'])->name('pemasukan.delete');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/edit/{id_pengeluaran}', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/update/{id_pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/delete/{id_pengeluaran}', [PengeluaranController::class, 'delete'])->name('pengeluaran.delete');

});
Route::group(['prefix' => 'yayasan', 'middleware' => ['auth:web', 'role:yayasan']], function () {
    Route::get('', [YayasanHomeController::class, 'index'])->name('yayasan');
    Route::get('/chart/get-total-pemasukan-pengeluaran', [YayasanHomeController::class,'getTotalPemasukanPengeluaran']);
    Route::get('/dashboard', [YayasanHomeController::class, 'index'])->name('yayasan.dashboard');
    Route::get('/pemasukan', [YayasanHomeController::class, 'pemasukan'])->name('yayasan.pemasukan');
    Route::get('/pengeluaran', [YayasanHomeController::class, 'pengeluaran'])->name('yayasan.pengeluaran');

    //
});

Route::group(['prefix' => 'siswa', 'middleware' => ['auth:siswa']], function () {
    Route::get('', [SiswaHomeController::class, 'index'])->name('siswa.index');
    Route::get('/dashboard', [SiswaHomeController::class, 'index'])->name('siswa.dashboard');

    Route::get('/tagihan/show', [SiswaTagihanController::class, 'show'])->name('siswa.tagihan.show');
    Route::put('/tagihan/bayar', [SiswaTagihanController::class, 'bayar'])->name('siswa.tagihan.bayar');

    //
});