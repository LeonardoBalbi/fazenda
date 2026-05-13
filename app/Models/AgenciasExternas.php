<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenciasExternas extends Model
{
    use HasFactory;

    protected $table = 'agencias_externas';

    protected $fillable = [
        'user_id',
        'status',
        'transportadoras_id',
        'alterado_por',
        'nome',
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
        'email',
        'observacao',
        'comprovante',
        'comprovante_retorno',
        'nome_responsavel',
    ];

    protected $casts = [
        'data_chegada' => 'date',
        'data_saida'   => 'date',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadoras::class, 'transportadoras_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
