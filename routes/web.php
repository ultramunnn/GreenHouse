<?php

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

// Landing page untuk semua pengunjung
Route::get('/', function () {
    return view('welcome');
});

// Guest Routes (Unauthenticated Users)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('filament.user.auth.login');
    })->name('login');
    
    Route::get('/register', function () {
        return redirect()->route('filament.user.auth.register');
    })->name('register');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/user/dashboard');
    })->name('dashboard');
});
