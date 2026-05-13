<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngressoEspecial extends Model
{
    use HasFactory;

    protected $table = 'ingresso_especial';

    protected $fillable = [
        'status',
        'user_id',
        'alterado_por',
        'transportadoras_id',
        'organizador_esp',
        'cpf_cnpj',
        'numero_cadastro_turismo',
        'motivo_visita',
        'local_partida',
        'destino',
        'tipo_veiculo',
        'marca_modelo_veiculo',
        'placa_veiculo',
        'renavam',
        'passageiros',
        'endereco',
        'data_chegada',
        'hora_chegada',
        'data_saida',
        'hora_saida',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'observacao',
        'lista_passageiros',
        'comprovante',
    ];

    protected $casts = [
        'data_chegada' => 'date',
        'data_saida' => 'date',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadoras::class, 'transportadoras_id');
    }

    public function alteradoPor()
    {
        return $this->belongsTo(User::class, 'alterado_por');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getListaPassageirosSanitizedAttribute(): string
    {
        $raw = $this->attributes['lista_passageiros'] ?? '';

        return html_entity_decode(strip_tags((string) $raw), ENT_QUOTES, 'UTF-8');
    }
}
