<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // O método UP é o que "faz" a mudança
        Schema::table('chamados', function (Blueprint $table) {
            
            // ADICIONA A COLUNA 'prioridade'
            // depois da coluna 'status', com 'baixa' como padrão
            $table->string('prioridade')->default('baixa')->after('status');
            
            // ADICIONA A COLUNA 'agent_id' (para o técnico responsável)
            // depois da coluna 'user_id'. Pode ser nulo.
            $table->foreignId('agent_id')->nullable()->after('user_id')
                  ->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // O método DOWN é o que "desfaz" a mudança
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropForeign(['agent_id']); // Remove a chave estrangeira
            $table->dropColumn(['prioridade', 'agent_id']); // Remove as duas colunas
        });
    }
};