<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route utama yang langsung mengarah ke Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route pelengkap untuk aksi CRUD pelatihan dan uraian kegiatan
Route::resource('trainings', App\Http\Controllers\TrainingController::class);
Route::resource('activities', App\Http\Controllers\ActivityController::class)->except(['index']);