<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Message;

Route::get('/', function () {
    return inertia('PortofoliuPublic', [
        'proiecte' => Project::all(),
    ]);
})->name('portofoliu.public');

Route::get('/dashboard', function () {
    // 1. Extragere toate tehnologiile din proiecte (rezultă o colecție de array-uri)
    $toateTehnologiile = Project::pluck('tehnologii');

    // 2. Procesare: le unim pe toate într-o listă unică, eliminăm duplicatele și curățăm spațiile
    $tehnologiiUnice = $toateTehnologiile->flatten()
        ->map(fn($tech) => trim($tech))
        ->unique()
        ->filter(); // Elimină eventualele valori goale

    // MODIFICARE: Trimitem și mesajele din MySQL în interfața Dashboard
    return inertia('Dashboard', [
        'totalProiecte' => Project::count(),
        'totalTehnologii' => $tehnologiiUnice->count(),
        'mesaje' => Message::latest()->get(), // Adus din MySQL (cele mai noi primele)
        'mesajeNecitite' => Message::where('citit', false)->count(), // Numărător mesaje noi
    ]);
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

Route::put('/proiecte/{project}', function (Request $request, Project $project) {
    // Validăm noile date trimise
    $dateValidate = $request->validate([
        'titlu' => 'required|string|max:255',
        'descriere' => 'required|string',
        'tehnologii' => 'required|array',
        'imagine' => 'nullable|url',
        'link_github' => 'nullable|url',
    ]);

    // Actualizăm proiectul în baza de date
    $project->update($dateValidate);

    return back();
})->middleware(['auth', 'verified'])->name('proiecte.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contact', function (Request $request) {
    // 1. Validăm datele din formular (securitate)
    $dateValidate = $request->validate([
        'nume' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subiect' => 'nullable|string|max:255',
        'continut' => 'required|string|min:10',
    ]);

    // 2. Salvăm mesajul în baza de date
    Message::create($dateValidate);

    // 3. Trimitem utilizatorul înapoi cu un mesaj de succes
    return back()->with('succes', 'Mesajul tău a fost trimis cu succes!');
})->name('contact.trimite');

// Rută pentru marcarea mesajului ca citit
Route::patch('/mesaje/{message}/citit', function (Message $message) {
    $message->update(['citit' => true]);
    return back();
})->middleware(['auth', 'verified'])->name('mesaje.citit');

// Rută pentru ștergerea definitivă a unui mesaj
Route::delete('/mesaje/{message}', function (Message $message) {
    $message->delete();
    return back();
})->middleware(['auth', 'verified'])->name('mesaje.destroy');

require __DIR__ . '/auth.php';