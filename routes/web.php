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
|
| Semua orang dapat mengakses halaman ini tanpa login.
|
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('pelatihans', PelatihanController::class)
    ->only([
        'index',
        'show'
    ]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Hanya administrator yang sudah login.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CRUD Pelatihan
    |--------------------------------------------------------------------------
    */

    Route::resource('pelatihans', PelatihanController::class)
        ->except([
            'index',
            'show'
        ]);

    /*
    |--------------------------------------------------------------------------
    | CRUD Uraian
    |--------------------------------------------------------------------------
    */

    Route::resource('uraians', UraianController::class);

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';