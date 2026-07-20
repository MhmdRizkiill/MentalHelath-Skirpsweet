<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Landing Page (Akses Publik)
Route::get('/', function () {
    return view('welcome'); // Memanggil file welcome.blade.php
})->name('home'); // <-- Tambahan name('home') di sini

// ==========================================
// GRUP ROUTE GUEST (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    // Rute Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Rute Register 
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Prosedur Logout (Harus dalam kondisi sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// GRUP ROUTE AUTH (Sudah Login)
// ==========================================
Route::middleware('auth')->group(function () {

    // ------------------------------------------
    // RUTE PROFIL (Bisa diakses Admin & Mahasiswa)
    // ------------------------------------------
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // ------------------------------------------
    // SUB-GRUP: HAK AKSES ADMIN
    // ------------------------------------------
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard Utama Admin
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        
        // CRUD Master Data Pertanyaan DASS-42
        Route::resource('questions', QuestionController::class)->except(['show']);
        
        // CRUD Manajemen Data Akun Mahasiswa
        Route::resource('users', UserController::class)->except(['show']);
    });

    // ------------------------------------------
    // SUB-GRUP: HAK AKSES MAHASISWA
    // ------------------------------------------
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        // Dashboard Utama Mahasiswa
        Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard');
        
        // Proses Skrining Kesehatan Mental DASS-42
        Route::get('/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
        
        // Halaman Onboarding Sebelum Skrining
        Route::get('/screenings/onboarding', [ScreeningController::class, 'onboarding'])->name('screenings.onboarding');
        
        // Form & Proses Skrining
        Route::get('/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
        Route::post('/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
        Route::get('/screenings/{id}', [ScreeningController::class, 'show'])->name('screenings.show');
    });

});