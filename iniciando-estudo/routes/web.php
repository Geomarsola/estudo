<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página inicial redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// ----------------------
// LOGIN / LOGOUT
// ----------------------

// Formulário de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Processar login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------
// ROTAS PROTEGIDAS (usuário logado)
// ----------------------
Route::middleware('auth')->group(function () {

    // PROFILE (mantido do Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PAINEL ADMIN (para usuários com role = admin)
    Route::get('/admin', function () {
        return "Painel Admin"; // futuramente trocar para view('admin.dashboard')
    })->name('admin.dashboard');

    // PAINEL FRENTISTA (para usuários com role = frentista)
    Route::get('/frentista', function () {
        return "Painel Frentista"; // futuramente trocar para view('frentista.dashboard')
    })->name('frentista.dashboard');
});

// Mantém rotas padrão de auth do Laravel
require __DIR__.'/auth.php';
