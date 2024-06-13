web.php:

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
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])-> name('produk.edit');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/destroy/{edit}', [ProdukController::class,'destroy'])-> name('produk.destroy');
Route::put('/produk/update/{id}', [ProdukController::class, 'update'])-> name('produk.update');

Route::get('/error', function () {
    return view('error', ['title' => 'Error']);
});