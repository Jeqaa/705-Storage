<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
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

// Route::get('/', function () {
//     return view('home' , ['title' => 'Home']);
// });

Route::get('/history', function () {
    return view('history', ['title' => 'History']);
});
Route::get('/setting', function () {
    return view('setting', ['title' => 'Setting']);
});

// Route::get('/produk', [ProdukController::class, 'index'])-> name('produk');
Route::get('/', [ProdukController::class, 'index'])-> name('produk');
Route::get('/produk', [ProdukController::class, 'index'])-> name('produk');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::delete('/produk/destroy/{nama_produk}', [ProdukController::class,'destroy'])-> name('produk.destroy');