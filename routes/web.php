<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::view('/', 'welcome')->name('welcome');

// Guest Routes (Unauthenticated Users)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return redirect('/admin/login');
    })->name('login');
    
    Route::get('/register', function () {
        return redirect('/admin/register');
    })->name('register');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Redirect to appropriate dashboard based on role
    Route::get('/dashboard', function() {
        return redirect('/admin/dashboard');
    })->name('dashboard');

    Route::get('/home', function() {
        return redirect()->route('dashboard');
    });
});
