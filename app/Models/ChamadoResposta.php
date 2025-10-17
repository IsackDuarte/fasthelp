<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChamadoResposta extends Model
{
    use HasFactory;

    protected $table = 'chamado_respostas'; // Especifica o nome da tabela

    protected $fillable = [
        'chamado_id',
        'user_id',
        'mensagem',
        'is_internal_note',
    ];

    // Relacionamento: A resposta pertence a um Chamado
    public function chamado(): BelongsTo {
        return $this->belongsTo(Chamado::class);
    }

    // Relacionamento: A resposta pertence a um Usuário (Autor)
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // Accessor: Retorna "há 5 minutos", "ontem"
    protected function createdAtHuman(): Attribute {
        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans(),
        );
    }
}