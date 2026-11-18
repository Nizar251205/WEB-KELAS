<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute untuk Website Profil, Dashboard, dan Struktur Jabatan Kelas.
| Seluruh data saat ini dimuat secara statis tanpa ketergantungan database,
| sehingga sangat mudah untuk di-push ke GitHub dan di-clone di perangkat lain.
|
*/

Route::get('/', [ClassController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [ClassController::class, 'dashboard']);
Route::get('/profile', [ClassController::class, 'profile'])->name('profile');
Route::get('/jabatan', [ClassController::class, 'jabatan'])->name('jabatan');
