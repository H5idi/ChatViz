<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $files = [];
    if (Storage::exists('chats')) {
        $allFiles = Storage::files('chats');
        // On filtre pour n'avoir que les fichiers de l'utilisateur (chat_ID_...)
        $userPrefix = 'chats/chat_' . auth()->id() . '_';
        foreach ($allFiles as $file) {
            if (str_starts_with($file, $userPrefix)) {
                $files[] = [
                    'name' => basename($file),
                    'path' => $file,
                    'date' => date('d/m/Y H:i', Storage::lastModified($file)),
                    'size' => round(Storage::size($file) / 1024, 2) . ' KB'
                ];
            }
        }
    }

    return view('dashboard', ['files' => $files]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes publiques
Route::get('/menu', function () { return view('welcome'); })->name('menu');
Route::get('/a-propos', function () { return view('welcome'); })->name('about');
Route::get('/contact', function () { return view('welcome'); })->name('contact');
Route::get('/safe-zone', function () { return view('welcome'); })->name('safe-zone');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
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
})->middleware(['auth'])->name('analyze');

Route::post('/delete-chat', function (Request $request) {
    $path = $request->input('path');
    // Sécurité : on vérifie que le fichier appartient bien à l'utilisateur
    $userPrefix = 'chats/chat_' . auth()->id() . '_';
    if (str_starts_with($path, $userPrefix) && Storage::exists($path)) {
        Storage::delete($path);
        return back()->with('success', 'Analyse supprimée.');
    }
    return back()->with('error', 'Action non autorisée.');
})->middleware(['auth'])->name('delete-chat');