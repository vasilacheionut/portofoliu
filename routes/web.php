<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
        'proiecte' => [
            [
                'id' => 1,
                'titlu' => 'Primul meu Portofoliu',
                'descriere' => 'O aplicație web modernă construită cu Laravel 12, Vue.js și Tailwind CSS.',
                'tehnologii' => ['Laravel', 'Vue', 'Tailwind'],
                'imagine' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=500&auto=format&fit=crop&q=60',
                'link_github' => 'https://github.com/vasilacheionut/portofoliu'
            ],
            [
                'id' => 2,
                'titlu' => 'Sistem de Analiză Date',
                'descriere' => 'Un script personal în Python și JavaScript pentru filtrarea și sortarea statisticilor matematice.',
                'tehnologii' => ['Python', 'JavaScript', 'HTML'],
                'imagine' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&auto=format&fit=crop&q=60',
                'link_github' => 'https://github.com/vasilacheionut' // Poți schimba ulterior cu linkul exact
            ]
        ]
    ]);
})->middleware(['auth', 'verified'])->name('proiecte');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
