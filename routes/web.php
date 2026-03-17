<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/analyze', function (Request $request) {
    if ($request->hasFile('chat_file')) {
        $file = $request->file('chat_file');

        $fileName = 'chat_' . auth()->id() . '_' . time() . '.txt';
        $file->storeAs('chats', $fileName);

        return redirect()->route('dashboard');
    }

    return back();
})->middleware(['auth']); 