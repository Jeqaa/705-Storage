<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryController;

// Route::get('/home', function () {
//     return view('home' , ['title' => 'Home']);
// });

// Route::get('/dashboard', [HomeController::class, 'dashboardlte']);



Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route untuk authetikasi, jadi gak usah verify email, user bisa akses ini
Route::middleware(['auth'])->group(function () {
    // route dibikin just in case ad yang pengen tambahin fitur kalo udah bikin akun tapi blm verifikasi email(?)
});

// Route untuk authetikasi yang harus verifikasi email.
Route::middleware(['auth', 'verified'])->group(function () {
    // Ini masih yang lama gtw buat apa
    Route::get('/history', function () {
        return view('history', ['title' => 'History']);
    })->name('history');
    Route::get('/setting', function () {
        return view('setting', ['title' => 'Setting']);
    })->name('setting');

    // CRUD Produk, ProdukController -> Redirect ke dashboardlte dengan data product
    Route::get('/', [ProdukController::class, 'index'])->name('produk');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');
    Route::delete('/produk/destroy/{edit}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.page');
    

    // CRUD History, HistoryController -> Redirect ke dashboardlte dengan data history
    // Route::get('/history', function () {
    //     return view('history', ['title' => 'history']);
    // })->name('history.page');
    

    // TAMBAHIN ROUTE LAIN
    // Route::get
});

Route::get('/error', function () {
    return view('error', ['title' => 'Error']);
});