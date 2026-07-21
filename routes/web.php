<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Pelatihan
|--------------------------------------------------------------------------
*/

/*
| Route yang berupa text HARUS di atas parameter {pelatihan}
*/

Route::get('/pelatihans', [PelatihanController::class, 'index'])
    ->name('pelatihans.index');

Route::middleware('auth')->group(function () {

    Route::get('/pelatihans/create', [PelatihanController::class, 'create'])
        ->name('pelatihans.create');

    Route::post('/pelatihans', [PelatihanController::class, 'store'])
        ->name('pelatihans.store');

    Route::get('/pelatihans/{pelatihan}/edit', [PelatihanController::class, 'edit'])
        ->name('pelatihans.edit');

    Route::put('/pelatihans/{pelatihan}', [PelatihanController::class, 'update'])
        ->name('pelatihans.update');

    Route::delete('/pelatihans/{pelatihan}', [PelatihanController::class, 'destroy'])
        ->name('pelatihans.destroy');

    Route::patch(
        '/pelatihans/{pelatihan}/favorite',
        [PelatihanController::class, 'favorite']
    )->name('pelatihans.favorite');

});

/*
| Route parameter PALING BAWAH
*/

Route::get('/pelatihans/{pelatihan}', [PelatihanController::class, 'show'])
    ->name('pelatihans.show');

Route::get('/uraians/{uraian}', [UraianController::class, 'show'])
    ->name('uraians.show');

/*
|--------------------------------------------------------------------------
| Uraian
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Form tambah uraian
    Route::get('/pelatihans/{pelatihan}/uraians/create', [UraianController::class, 'create'])
        ->name('uraians.create');

    // Simpan uraian baru
    Route::post('/pelatihans/{pelatihan}/uraians', [UraianController::class, 'store'])
        ->name('uraians.store');

    // Form edit uraian
    Route::get('/pelatihans/{pelatihan}/uraians/{uraian}/edit', [UraianController::class, 'edit'])
        ->name('uraians.edit');

    // Update uraian
    Route::put('/pelatihans/{pelatihan}/uraians/{uraian}', [UraianController::class, 'update'])
        ->name('uraians.update');

    // Hapus uraian
    Route::delete('/pelatihans/{pelatihan}/uraians/{uraian}', [UraianController::class, 'destroy'])
        ->name('uraians.destroy');

});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/activity-log', [ActivityLogController::class, 'index'])
        ->name('activity-log.index');

});

/*
|--------------------------------------------------------------------------
| Kelola User (Super Admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'superadmin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::patch(
        '/users/{user}/reset-password',
        [UserController::class, 'resetPassword']
    )->name('users.reset-password');

});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';