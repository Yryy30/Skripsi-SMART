<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/* SETTINGS */
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

/* Hanya Admin */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('kriteria', 'pages.smart.kriteria')->name('kriteria');
});

/* Admin dan Kader */
Route::middleware(['auth',])->group(function () {
    Route::view('balita', 'pages.balita.balita')->name('balita');
    Route::get('balita/detail/{id}', [BalitaController::class, 'balitaDetail'])->name('balita.detail');

    Route::view('alternatif', 'pages.smart.alternatif')->name('alternatif');

    Route::view('hasil', 'pages.smart.hasil')->name('hasil');
    
    Route::get('laporan/{tanggal}', [ExportController::class, 'exportLaporan'])->name('laporan');
    Route::view('laporan', 'pages.smart.laporan')->name('laporan.view');
});

require __DIR__.'/auth.php';
