web.php:

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('home' , ['title' => 'Home']);
// });

Route::get('/', [HomeController::class, 'dashboardlte']);

Route::get('/history', function () {
    return view('history', ['title' => 'History']);
});
Route::get('/setting', function () {
    return view('setting', ['title' => 'Setting']);
});
