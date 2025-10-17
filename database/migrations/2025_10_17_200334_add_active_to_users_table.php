<?php
use Illuminate.Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna 'active' depois da coluna 'email' (ex)
            // 'default(true)' significa que todos os usuários existentes 
            // e novos serão 'ativos' por padrão.
            $table->boolean('active')->default(true)->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
};