<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

// Página inicial redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// ----------------------
// LOGIN / LOGOUT (Laravel padrão / Breeze)
// ----------------------
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// ----------------------
// DASHBOARD genérico para redirecionamento
// ----------------------
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'frentista') {
        return redirect()->route('frentista.dashboard');
    }
    abort(403);
})->middleware('auth')->name('dashboard');

// ----------------------
// ROTAS ADMIN (Protegidas)
// ----------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return "Painel Admin"; // futuramente view('admin.dashboard')
    })->name('dashboard');

    // CRUD de produtos
    Route::resource('products', ProductController::class);
});

// ----------------------
// ROTAS FRENTISTA
// ----------------------
Route::middleware(['auth', 'frentista'])->group(function () {
    Route::get('/frentista', function () {
        return "Painel Frentista"; // futuramente view('frentista.dashboard')
    })->name('frentista.dashboard');
});

// ----------------------
// PROFILE (Laravel padrão)
// ----------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Mantém rotas padrão de auth do Laravel
require __DIR__.'/auth.php';
