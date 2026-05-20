<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/proiecte', function () {
    return inertia('Proiecte', [
        'proiecte' => Project::all()
    ]);
})->middleware(['auth', 'verified'])->name('proiecte');

Route::delete('/proiecte/{project}', function (Project $project) {
    $project->delete();
    return back(); // Reîmprospătează pagina automat cu lista actualizată
})->middleware(['auth', 'verified'])->name('proiecte.destroy');

Route::post('/proiecte', function (Request $request) {
    // Validăm datele primite din formular
    $dateValidate = $request->validate([
        'titlu' => 'required|string|max:255',
        'descriere' => 'required|string',
        'tehnologii' => 'required|array',
        'imagine' => 'nullable|url',
        'link_github' => 'nullable|url',
    ]);

    // Salvăm proiectul în MySQL folosind Modelul
    Project::create($dateValidate);

    return back(); // Împrospătează lista din pagină automat
})->middleware(['auth', 'verified'])->name('proiecte.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
