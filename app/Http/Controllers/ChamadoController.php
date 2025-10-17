<?php
namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\ChamadoResposta; // Importar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreChamadoRequest; // (Opcional: Crie um Form Request)

class ChamadoController extends Controller
{


    public function index()
    {
        // 1. Busca os chamados do banco de dados.
        //    'with('user')' é uma otimização para carregar os dados do usuário
        //    junto, evitando o "problema N+1".
        //    'latest()' ordena pelos mais novos.
        //    'paginate(15)' cria a paginação (15 itens por página).
        $chamados = Chamado::with('user')
                           ->latest()
                           ->paginate(15); 
                           
        // 2. Retorna a view 'chamados.blade.php' e passa os dados para ela.
        return view('chamados', [
            'chamados' => $chamados
        ]);
    }
    /**
     * STORE: Salva o novo chamado (do modal Criar)
     */
    public function store(Request $request) // (Troque 'Request' por 'StoreChamadoRequest' se usar Form Request)
    {
        $dadosValidados = $request->validate([
            'assunto' => 'required|string|max:255',
            'categoria' => 'required|string',
            'prioridade' => 'required|string', // (Use 'Rule::enum(ChamadoPrioridade::class)' se usar Enums)
            'descricao' => 'nullable|string',
        ]);

        // Cria a primeira "resposta" com a descrição original
        $chamado = Chamado::create([
            'assunto' => $dadosValidados['assunto'],
            'categoria' => $dadosValidados['categoria'],
            'prioridade' => $dadosValidados['prioridade'],
            'user_id' => Auth::id(),
            'status' => 'aberto',
            // 'agent_id' => null (pode ser definido por uma regra de automação depois)
        ]);
        
        // Adiciona a descrição como a primeira resposta na thread
        if(!empty($dadosValidados['descricao'])) {
            $chamado->respostas()->create([
                'user_id' => Auth::id(),
                'mensagem' => $dadosValidados['descricao'],
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * UPDATE: Atualiza o chamado (usado pelo botão "Marcar como Resolvido")
     */
    public function update(Request $request, Chamado $chamado)
    {
        // (Aqui você deve ter uma Policy para verificar se o usuário pode atualizar)
        // $this->authorize('update', $chamado);

        $dadosValidados = $request->validate([
            'status' => 'required|string|in:concluido', // Apenas permite marcar como concluído por esta rota
        ]);

        $chamado->update([
            'status' => $dadosValidados['status']
        ]);
        
        // (Opcional: Adicionar uma nota automática na thread)
        $chamado->respostas()->create([
            'user_id' => Auth::id(),
            'mensagem' => "O status do chamado foi alterado para: Concluído.",
            'is_internal_note' => true, // (Exemplo)
        ]);

        return redirect()->route('dashboard')->with('success', 'Chamado atualizado com sucesso!');
    }

    // ... seus outros métodos (index, create, show, edit, destroy) ...
    
    // =============================================================
    // NOVOS MÉTODOS PARA O MODAL AJAX
    // =============================================================

    /**
     * GET JSON DATA: Retorna os dados de um chamado para o AJAX
     */
    public function getJsonData(Chamado $chamado)
    {
        // (Verifica se o usuário pode ver este chamado)
        // $this->authorize('view', $chamado); 

        // Carrega os relacionamentos necessários
        $chamado->load(['user', 'agent', 'respostas.user']);

        // Adiciona os Accessors e URLs ao JSON
        $chamado->append([
            'status_label', 
            'prioridade_label', 
            'categoria_label'
        ]);
        
        // Adiciona as URLs que o JS vai precisar
        $chamado->urls = [
            'responder_url' => route('chamados.responder', $chamado),
            'resolver_url' => route('chamados.update', $chamado),
        ];
        
        // Adiciona o Accessor 'created_at_human' para cada resposta
        $chamado->respostas->each(function($resposta) {
            $resposta->append('created_at_human');
            // Verifica se a resposta é de um agente (ex: usuário tem role 'admin' ou 'agent')
            $resposta->is_agent = $resposta->user->is_admin; // (Ajuste 'is_admin' para sua lógica)
        });

        return response()->json($chamado);
    }

    /**
     * RESPONDER: Adiciona uma nova resposta ao chamado
     */
    public function responder(Request $request, Chamado $chamado)
    {
        // (Verifica se o usuário pode responder)
        // $this->authorize('reply', $chamado);

        $dadosValidados = $request->validate([
            'mensagem' => 'required|string',
        ]);

        $chamado->respostas()->create([
            'user_id' => Auth::id(),
            'mensagem' => $dadosValidados['mensagem'],
        ]);
        
        // (Opcional: Mudar status para 'em_andamento' se um agente responder)
        if (Auth::user()->is_admin && $chamado->status == 'aberto') {
             $chamado->update(['status' => 'em_andamento']);
        }

        // Redireciona de volta. Como foi um AJAX, o JS do modal *não*
        // vai seguir o redirect, mas é bom ter. O ideal é só retornar JSON.
        // return response()->json(['success' => 'Resposta adicionada.']);
        
        // Para um form-submit simples, o 'back()' funciona e recarrega a página.
        return redirect()->back()->with('success', 'Resposta adicionada com sucesso!');
    }
}