<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizadores', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Em análise');
            $table->string('tipo_cadastro');
            $table->string('cnpj_cpf');
            $table->string('razao_social_nome');
            $table->string('nome_fantasia')->nullable();
            $table->boolean('inscricao_municipal')->nullable();
            $table->string('inscricao_municipal_numero')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->string('cep');
            $table->string('endereco');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('municipio');
            $table->string('estado');
            $table->string('telefone_celular');
            $table->string('telefone_fixo')->nullable();
            $table->string('email_responsavel');
            $table->string('nome_responsavel');
            $table->string('telefone_responsavel');
            $table->timestamps();
        });

        Schema::create('transportadoras', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Em análise');
            $table->string('nome');
            $table->string('cpf_cnpj');
            $table->string('numero_cadastro_turismo');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('telefone');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('passeios_turisticos', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Em análise');
            $table->foreignId('alterado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->string('motivo_visita')->nullable();
            $table->string('local_partida')->nullable();
            $table->string('destino')->nullable();
            $table->unsignedInteger('transportadoras_id')->nullable();
            $table->unsignedBigInteger('organizador_id')->nullable();
            $table->string('tipo_veiculo')->nullable();
            $table->string('marca_modelo_veiculo')->nullable();
            $table->string('placa_veiculo')->nullable();
            $table->string('renavam')->nullable();
            $table->integer('passageiros')->nullable();
            $table->longText('lista_passageiros')->nullable();
            $table->date('data_chegada')->nullable();
            $table->time('hora_chegada')->nullable();
            $table->date('data_saida')->nullable();
            $table->time('hora_saida')->nullable();
            $table->string('observacao')->nullable();
            $table->string('comprovante')->nullable();
            $table->timestamps();
        });

        Schema::create('agencias_externas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default('Em análise');
            $table->unsignedBigInteger('transportadoras_id')->nullable();
            $table->foreignId('alterado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nome')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('numero_cadastro_turismo')->nullable();
            $table->string('motivo_visita')->nullable();
            $table->string('local_partida')->nullable();
            $table->string('destino')->nullable();
            $table->string('tipo_veiculo')->nullable();
            $table->string('marca_modelo_veiculo')->nullable();
            $table->string('placa_veiculo')->nullable();
            $table->string('renavam')->nullable();
            $table->integer('passageiros')->nullable();
            $table->string('endereco')->nullable();
            $table->date('data_chegada')->nullable();
            $table->time('hora_chegada')->nullable();
            $table->date('data_saida')->nullable();
            $table->time('hora_saida')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('observacao')->nullable();
            $table->string('comprovante')->nullable();
            $table->string('comprovante_retorno')->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->timestamps();
        });

        Schema::create('ingresso_especial', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Em análise');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('alterado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedBigInteger('transportadoras_id')->nullable();
            $table->string('organizador_esp')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('numero_cadastro_turismo')->nullable();
            $table->string('motivo_visita')->nullable();
            $table->string('local_partida')->nullable();
            $table->string('destino')->nullable();
            $table->string('tipo_veiculo')->nullable();
            $table->string('marca_modelo_veiculo')->nullable();
            $table->string('placa_veiculo')->nullable();
            $table->string('renavam')->nullable();
            $table->string('passageiros')->nullable();
            $table->string('endereco')->nullable();
            $table->date('data_chegada')->nullable();
            $table->time('hora_chegada')->nullable();
            $table->date('data_saida')->nullable();
            $table->time('hora_saida')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->string('observacao')->nullable();
            $table->string('comprovante')->nullable();
            $table->timestamps();
        });

        Schema::create('ingresso_servicos', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('Em análise');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('alterado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedBigInteger('transportadoras_id')->nullable();
            $table->string('nome')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('motivo_visita')->nullable();
            $table->string('local_partida')->nullable();
            $table->string('destino')->nullable();
            $table->string('tipo_veiculo')->nullable();
            $table->string('marca_modelo_veiculo')->nullable();
            $table->string('placa_veiculo')->nullable();
            $table->string('renavam')->nullable();
            $table->string('passageiros')->nullable();
            $table->date('data_chegada')->nullable();
            $table->time('hora_chegada')->nullable();
            $table->date('data_saida')->nullable();
            $table->time('hora_saida')->nullable();
            $table->string('observacao')->nullable();
            $table->string('comprovante')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresso_servicos');
        Schema::dropIfExists('ingresso_especial');
        Schema::dropIfExists('agencias_externas');
        Schema::dropIfExists('passeios_turisticos');
        Schema::dropIfExists('transportadoras');
        Schema::dropIfExists('organizadores');
    }
};
