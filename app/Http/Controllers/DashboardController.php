<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\User; // Supondo que você tenha um model de Ativos
// use App\Models\Ativo; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe o painel principal do dashboard.
     */
    public function index()
    {
        // Pega os 5 chamados mais recentes, já carregando a info do usuário
        $chamadosRecentes = Chamado::with('user')
                                ->latest() // Ordena por created_at DESC
                                ->take(5)
                                ->get();
        
        // Dados para os cards
        $totalAbertos = Chamado::where('status', 'aberto')->count();
        $totalAtivos = 0; // Exemplo: $totalAtivos = Ativo::count();
        $totalUsuarios =User::count();
        
        // Retorna a view 'dashboard.blade.php' e passa as variáveis
        return view('dashboard', [
            'chamados' => $chamadosRecentes,
            'totalAbertos' => $totalAbertos,
            'totalAtivos' => $totalAtivos,
            'totalUsuarios' => $totalUsuarios,
        ]);
    }
}