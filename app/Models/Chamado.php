<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Importar
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// (Opcional, mas boa prática) Crie Enums para Status e Prioridade
enum ChamadoStatus: string {
    case ABERTO = 'aberto';
    case EM_ANDAMENTO = 'em_andamento';
    case CONCLUIDO = 'concluido';
}
enum ChamadoPrioridade: string {
    case BAIXA = 'baixa';
    case MEDIA = 'media';
    case ALTA = 'alta';
}


class Chamado extends Model
{
    use HasFactory;

    protected $fillable = [
        'assunto',
        'categoria',
        'descricao',
        'status',
        'prioridade', // Novo
        'user_id',
        'agent_id',   // Novo
    ];

    // Casts para usar os Enums
    protected $casts = [
        'status' => ChamadoStatus::class,
        'prioridade' => ChamadoPrioridade::class,
    ];

    // Relacionamento: Um chamado pertence a um Usuário (Solicitante)
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento: Um chamado pertence a um Agente (Técnico)
    public function agent(): BelongsTo {
        return $this->belongsTo(User::class, 'agent_id');
    }

    // Relacionamento: Um chamado TEM MUITAS Respostas
    public function respostas(): HasMany {
        return $this->hasMany(ChamadoResposta::class)->orderBy('created_at', 'asc');
    }

    // --- Accessors (para o JSON ficar bonito) ---

    // Retorna "Baixa", "Média", "Alta"
    protected function prioridadeLabel(): Attribute {
        return Attribute::make(
            get: fn () => match ($this->prioridade) {
                ChamadoPrioridade::BAIXA => 'Baixa',
                ChamadoPrioridade::MEDIA => 'Média',
                ChamadoPrioridade::ALTA => 'Alta',
                default => 'N/A'
            },
        );
    }

    // Retorna "Aberto", "Concluído", etc.
    protected function statusLabel(): Attribute {
        return Attribute::make(
            get: fn () => match ($this->status) {
                ChamadoStatus::ABERTO => 'Aberto',
                ChamadoStatus::EM_ANDAMENTO => 'Em Andamento',
                ChamadoStatus::CONCLUIDO => 'Concluído',
                default => 'N/A'
            },
        );
    }

    // Retorna "Hardware", "Software", etc.
    protected function categoriaLabel(): Attribute {
        return Attribute::make(
            get: fn () => ucfirst($this->categoria) // Simples, melhore se precisar
        );
    }
}