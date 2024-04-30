<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
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

route::get('/dashboard', [HomeController::class,'index'])->name('admin.dashboard');

route::get('/tagihan', [HomeController::class,'tagihan'])->name('tagihan.index');


Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{nis}', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::post('/siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{nis}', [SiswaController::class, 'delete'])->name('siswa.delete');