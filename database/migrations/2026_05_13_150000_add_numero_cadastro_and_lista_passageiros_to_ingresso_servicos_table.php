<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ingresso_servicos', 'numero_cadastro_turismo')) {
            Schema::table('ingresso_servicos', function (Blueprint $table) {
                $table->string('numero_cadastro_turismo', 80)->nullable()->after('cpf_cnpj');
            });
        }

        if (! Schema::hasColumn('ingresso_servicos', 'lista_passageiros')) {
            Schema::table('ingresso_servicos', function (Blueprint $table) {
                $table->text('lista_passageiros')->nullable()->after('observacao');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ingresso_servicos', 'lista_passageiros')) {
            Schema::table('ingresso_servicos', function (Blueprint $table) {
                $table->dropColumn('lista_passageiros');
            });
        }

        if (Schema::hasColumn('ingresso_servicos', 'numero_cadastro_turismo')) {
            Schema::table('ingresso_servicos', function (Blueprint $table) {
                $table->dropColumn('numero_cadastro_turismo');
            });
        }
    }
};
