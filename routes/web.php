<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Halaman daftar pelatihan
Route::get('/pelatihans', [PelatihanController::class, 'index'])
    ->name('pelatihans.index');

// Detail pelatihan
Route::get('/pelatihans/{pelatihan}', [PelatihanController::class, 'show'])
    ->name('pelatihans.show');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // CRUD Pelatihan
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

    // CRUD Uraian
    Route::resource('uraians', UraianController::class)->except(['index']);

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Breeze Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';