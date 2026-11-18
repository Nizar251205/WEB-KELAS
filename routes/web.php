<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\StrukturKelasController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Struktur Kelas SI2A
|--------------------------------------------------------------------------
| Disesuaikan 100% dengan Activity Diagram Pemrograman Website [PSI3310]
| Politeknik Negeri Subang - Kelompok 4
| Berjalan tanpa database (No-DB JSON Data Store, siap push & clone GitHub).
*/

// --- AUTENTIKASI (Activity Diagram Page 2) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// --- DASHBOARD (Activity Diagram Page 3) ---
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

// --- PROFIL KELAS (Activity Diagram Page 4 & Page 8) ---
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::post('/profil/simpan', [ProfilController::class, 'save'])->name('profil.save');
Route::post('/profil/hapus', [ProfilController::class, 'destroy'])->name('profil.destroy');
Route::post('/profil/reset', [ProfilController::class, 'reset'])->name('profil.reset');

// --- DAFTAR & KELOLA MAHASISWA (Activity Diagram Page 5, 6, & 9) ---
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/detail/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
Route::post('/mahasiswa/simpan', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::post('/mahasiswa/hapus/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

// --- STRUKTUR KELAS & ATUR JABATAN (Activity Diagram Page 7 & 10) ---
Route::get('/struktur-kelas', [StrukturKelasController::class, 'index'])->name('struktur.index');
Route::post('/struktur-kelas/atur-jabatan', [StrukturKelasController::class, 'aturJabatan'])->name('struktur.atur');

// --- GENERATE LAPORAN (Activity Diagram Page 11 & 12) ---
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
