<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;

// Route::get('/home', function () {
//     return view('home' , ['title' => 'Home']);
// });

// Route::get('/dashboard', [HomeController::class, 'dashboardlte']);

Route::get('/history', function () {
    return view('history', ['title' => 'History']);
});
Route::get('/setting', function () {
    return view('setting', ['title' => 'Setting']);
});

Route::get('/', [ProdukController::class, 'index'])-> name('produk');
Route::get('/produk', [ProdukController::class, 'index'])-> name('produk');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');
Route::delete('/produk/destroy/{nama_produk}', [ProdukController::class,'destroy'])-> name('produk.destroy');