<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes publiques
Route::get('/menu', function () { return view('welcome'); })->name('menu');
Route::get('/a-propos', function () { return view('welcome'); })->name('about');
Route::get('/contact', function () { return view('welcome'); })->name('contact');
Route::get('/safe-zone', function () { return view('welcome'); })->name('safe-zone');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
