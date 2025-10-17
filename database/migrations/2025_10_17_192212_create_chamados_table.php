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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('assunto');
            $table->string('categoria'); // hardware, software, rede, etc.
            $table->text('descricao')->nullable();
            $table->string('status')->default('aberto'); // aberto, em_andamento, concluido
            
            // Chave estrangeira para o usuário que criou o chamado
            // Garante que o usuário exista na tabela 'users'
            // E se o usuário for deletado, seus chamados também serão (onDelete)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};