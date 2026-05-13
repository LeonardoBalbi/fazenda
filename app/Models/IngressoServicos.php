<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngressoServicos extends Model
{
    use HasFactory;

    protected $table = 'ingresso_servicos';

    protected $fillable = [
        'status',
        'user_id',
        'alterado_por',
        'transportadoras_id',
        'nome',
        'cpf_cnpj',
        'motivo_visita',
        'local_partida',
        'destino',
        'tipo_veiculo',
        'marca_modelo_veiculo',
        'placa_veiculo',
        'renavam',
        'passageiros',
        'data_chegada',
        'hora_chegada',
        'data_saida',
        'hora_saida',
        'observacao',
        'comprovante',
    ];

    protected $casts = [
        'data_chegada' => 'date',
        'data_saida'   => 'date',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadoras::class, 'transportadoras_id');
    }
}
