<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
// Route untuk halaman utama (opsional, jika ingin langsung diarahkan ke daftar mahasiswa)
Route::get('/', [MahasiswaController::class, 'index']);

// Daftar Route Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');