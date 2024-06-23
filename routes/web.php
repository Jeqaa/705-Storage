<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AssignPermissionController;
use App\Http\Controllers\ActiveRolesController;

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
    // ===================================================================================

    // ke halaman utama
    Route::get('/', [ProdukController::class, 'index']);
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');

    // untuk mengubah produk
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');

    // untuk menyimpan produk
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');

    // untuk mencari produk
    Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

    // untuk menghapus produk berdasarkan id
    Route::delete('/produk/destroy/{edit}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // untuk mengupdate produk berdasarkan id
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');

    // CRUD History
    // ===================================================================================

    // untuk pindah kehalaman history
    // Note : Route hanya 1 karena kebanyakan memakai controller di product (karna memang history terbentuk dari
    // perubahan produk yang dilakukan user)
    Route::get('/history', [HistoryController::class, 'index'])->name('history.page');

    // TAMBAHIN ROUTE LAIN
    // Route::get
});

Route::get('/error', function () {
    return view('error', ['title' => 'Error']);
});

// Permission Routes
Route::controller(PermissionController::class)->group(function () {
    Route::get('/role-management', 'redirectToPermission');
    Route::get('/role-management/permission', 'viewPermission')->name('permission.view');
    Route::get('/role-management/permission/search', 'searchPermission')->name('permission.search');
    Route::post('/role-management/permission/store', 'storePermission')->name('permission.store');
    Route::get('/role-management/permission/edit/{id}', 'editPermission')->name('permission.edit');
    Route::put('/role-management/permission/update/{id}', 'updatePermission')->name('permission.update');
    Route::delete('/role-management/permission/delete/{id}', 'deletePermission')->name('permission.delete');
});

// Roles Routes
Route::controller(RoleController::class)->group(function () {
    Route::get('/role-management/roles', 'viewRoles')->name('roles.view');
    Route::post('/role-management/roles/store', 'storeRoles')->name('roles.store');
    Route::get('/role-management/roles/edit/{id}', 'editRoles')->name('roles.edit');
    Route::put('/role-management/roles/update/{id}', 'updateRoles')->name('roles.update');
    Route::delete('/role-management/roles/delete/{id}', 'deleteRoles')->name('roles.delete');
});

// Assign Permission Routes
Route::controller(AssignPermissionController::class)->group(function () {
    Route::get('/role-management/assign', 'viewAssignPermission')->name('assign.permission.view');
    Route::post('/role-management/assign/store', 'rolePermissionStore')->name('assign.store');
});

// Active Role Routes
Route::controller(ActiveRolesController::class)->group(function () {
    Route::get('/role-management/active-role', 'viewActiveRoles')->name('active.roles.view');
    Route::get('/role-management/active-role/edit/{id}', 'editActiveRoles')->name('active.roles.edit');
    Route::put('/role-management/active-role/update/{id}', 'updateActiveRoles')->name('active.roles.update');
    Route::delete('/role-management/active-role/delete/{id}', 'deleteActiveRoles')->name('active.roles.delete');
});
