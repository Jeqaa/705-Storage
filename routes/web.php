<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActiveRolesController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Overview Routes
    Route::get('/', [DashboardController::class, 'view'])->name('dashboard.view')->middleware('permission:dashboard.view');

    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile.edit')->middleware('permission:profile.view');
        Route::post('/profile/update-name/{id}', 'updateName')->name('profile.updateName')->middleware('permission:profile.edit');
        Route::get('/profile/send-to-old-mail/{id}/', 'sendToOldMail')->name('profile.sendToOldMail')->middleware('permission:profile.edit');
        Route::post('/profile/send-to-new-mail/{id}/', 'sendToNewMail')->name('profile.sendToNewMail')->middleware('permission:profile.edit');
        Route::get('/profile/send-reset-password/{id}/', 'sendResetPassword')->name('profile.sendResetPassword')->middleware('permission:profile.edit');
        Route::get('/profile/otp}', 'otp')->name('profile.otp')->middleware('permission:profile.edit');
        Route::post('/profile/verify-otp/{id}', 'verifyOtp')->name('profile.verifyOtp')->middleware('permission:profile.edit');
        Route::get('/profile/change-mail-page', 'changeMailPage')->name('profile.changeMailPage')->middleware('permission:profile.edit');
        Route::get('/profile/change-password-page', 'changePasswordPage')->name('profile.changePasswordPage')->middleware('permission:profile.edit');
        Route::post('/profile/change-password/{id}', 'changePassword')->name('profile.changePassword')->middleware('permission:profile.edit');
        Route::post('/profile/change-picture/{id}', 'changePicture')->name('profile.changePicture')->middleware('permission:profile.edit');
    });

    // Produk Routes
    Route::controller(ProdukController::class)->group(function () {
        Route::get('/produk', 'index')->name('produk')->middleware('permission:produk.view');
        Route::get('/produk/search', 'search')->name('produk.search')->middleware('permission:produk.view');
        Route::post('/produk/store', 'store')->name('produk.store')->middleware('permission:produk.store');;
        Route::get('/produk/edit/{id}', 'edit')->name('produk.edit')->middleware('permission:produk.edit');;
        Route::put('/produk/update/{id}', 'update')->name('produk.update')->middleware('permission:produk.edit');;
        Route::delete('/produk/destroy/{edit}', 'destroy')->name('produk.destroy')->middleware('permission:produk.delete');;
    });

    // History Routes
    Route::get('/history', [HistoryController::class, 'index'])->name('history.view')->middleware('permission:history.view');

    // To do routes
    Route::controller(TodoController::class)->group(function () {
        Route::get('/to-dos', 'viewTodos')->name('to-dos.view')->middleware('permission:todos.view');
        Route::post('/to-dos/store', 'todoStore')->name('to-dos.store')->middleware('permission:todos.store');
        Route::get('/to-dos/edit/{id}', 'editTodo')->name('to-dos.edit')->middleware('permission:todos.edit');
        Route::put('/to-dos/update/{id}', 'updateTodo')->name('to-dos.update')->middleware('permission:todos.edit');
        Route::patch('/to-dos/done/{id}', 'markAsDone')->name('to-dos.markAsDone')->middleware('permission:todos.edit');
        Route::patch('/to-dos/undone/{id}', 'markAsUndone')->name('to-dos.markAsUndone')->middleware('permission:todos.edit');
        Route::delete('/to-dos/delete/{id}', 'deleteTodo')->name('to-dos.delete')->middleware('permission:todos.delete');
    });

    // Permission Routes
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/role-management', 'redirectToPermission');
        Route::get('/role-management/permission', 'viewPermission')->name('permission.view')->middleware('permission:permission.view');
        Route::post('/role-management/permission/store', 'storePermission')->name('permission.store')->middleware('permission:permission.store');;
        Route::get('/role-management/permission/edit/{id}', 'editPermission')->name('permission.edit')->middleware('permission:permission.edit');;
        Route::put('/role-management/permission/update/{id}', 'updatePermission')->name('permission.update')->middleware('permission:permission.edit');;
        Route::delete('/role-management/permission/delete/{id}', 'deletePermission')->name('permission.delete')->middleware('permission:permission.delete');;
    });

    // Roles Routes
    Route::controller(RoleController::class)->group(function () {
        Route::get('/role-management/roles', 'viewRoles')->name('roles.view')->middleware('permission:roles.view');
        Route::post('/role-management/roles/store', 'storeRoles')->name('roles.store')->middleware('permission:roles.store');
        Route::get('/role-management/roles/edit/{id}', 'editRoles')->name('roles.edit')->middleware('permission:roles.edit');
        Route::put('/role-management/roles/update/{id}', 'updateRoles')->name('roles.update')->middleware('permission:roles.edit');
        Route::delete('/role-management/roles/delete/{id}', 'deleteRoles')->name('roles.delete')->middleware('permission:roles.delete');
    });

    // Active Role Routes
    Route::controller(ActiveRolesController::class)->group(function () {
        Route::get('/role-management/active-role', 'viewActiveRoles')->name('active.roles.view')->middleware('permission:active.roles.view');
        Route::get('/role-management/active-role/edit/{id}', 'editActiveRoles')->name('active.roles.edit')->middleware('permission:active.roles.edit');
        Route::put('/role-management/active-role/update/{id}', 'updateActiveRoles')->name('active.roles.update')->middleware('permission:active.roles.edit');
        Route::delete('/role-management/active-role/delete/{id}', 'deleteActiveRoles')->name('active.roles.delete')->middleware('permission:active.roles.delete');
    });

    // Manage User Routes
    Route::controller(ManageUserController::class)->group(function () {
        Route::get('/manage-users', 'viewUsers')->name('manage-users.view')->middleware('permission:user.management.view');
        Route::get('/manage-users/edit/{id}', 'editUser')->name('manage-users.edit')->middleware('permission:user.management.edit');
        Route::put('/manage-users/update/{id}', 'updateUser')->name('manage-users.update')->middleware('permission:user.management.edit');
        Route::delete('/manage-users/delete/{id}', 'deleteUser')->name('manage-users.delete')->middleware('permission:user.management.delete');
    });

    // Manage Annoncements
    Route::controller(AnnouncementController::class)->group(function () {
        Route::get('/announcements', 'index')->name('announcement.view')->middleware('permission:announcement.view');
        Route::get('/announcements/create', 'create')->name('announcement.create')->middleware('permission:announcement.store');
        Route::post('/announcements', 'store')->name('announcement.store')->middleware('permission:announcement.store');
        Route::get('/announcements/{id}/edit', 'edit')->name('announcement.edit')->middleware('permission:announcement.edit');
        Route::put('/announcements/{id}', 'update')->name('announcement.update')->middleware('permission:announcement.edit');
        Route::delete('/announcements/{id}', 'delete')->name('announcement.delete')->middleware('permission:announcement.delete');
        Route::post('/announcements/{id}/toggle-show', 'toggleShow')->name('announcement.toggle-show')->middleware('permission:announcement.edit');
    });
});



// web.php



// Route::get('/error', function () {
//     return view('error', ['title' => 'Error']);
// });
