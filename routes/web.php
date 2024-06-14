<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will be assigned to
| the "web" middleware group. Create something great!
|
*/

Route::get('/', function () {
    return view('home2', ['title' => 'Home']);
});

// Route untuk authetikasi, jadi gak usah verify email, user bisa akses ini
Route::middleware(['auth'])->group(function () {
    
});

// Route untuk authetikasi yang harus verifikasi email.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/history', function () {
        return view('history', ['title' => 'History']);
    })->name('history');
    Route::get('/setting', function () {
        return view('setting', ['title' => 'Setting']);
    })->name('setting');
    // TAMBAHIN ROUTE LAIN
    // Route::get
});
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
