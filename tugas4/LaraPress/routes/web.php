<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang-kami', function () {
    return view('about');
});

Route::get('/kontak', function () {
    return view('contact');
});

// Contoh pengamanan rute CRUD menggunakan middleware auth (Tugas 4)
Route::middleware('auth')->group(function () {
    // Contoh rute yang diproteksi dan hanya bisa diakses setelah login
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Tambahkan rute CRUD Anda di sini (misal: post create, edit, delete)
});

// Memuat rute autentikasi bawaan dari Laravel Breeze
require __DIR__.'/auth.php';