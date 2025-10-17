<?php
// ...
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChamadoController;

// --- 1. ROTAS DE AUTENTICAÇÃO ---
// Esta linha CRIA a rota 'login'
Auth::routes(); 

// ...
Route::get('/home', [DashboardController::class, 'index'])->name('home');

// --- 2. ROTAS PROTEGIDAS (Exigem Login) ---
// Este grupo USA a rota 'login'

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ... todas as suas rotas de chamados ...
    Route::get('/chamados', [ChamadoController::class, 'index'])->name('chamados.index');
    Route::post('/chamados', [ChamadoController::class, 'store'])->name('chamados.store');
    // ... etc ...


// (Não deve ter o 'require __DIR__.'/auth.php';' aqui se você usou laravel/ui)