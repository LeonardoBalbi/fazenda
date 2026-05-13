<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasseiosTuristicos extends Model
{
    use HasFactory;

    protected $table = 'passeios_turisticos';

    protected $fillable = [
        'status',
        'alterado_por',
        'motivo_visita',
        'local_partida',
        'destino',
        'transportadoras_id',
        'organizador_id',
        'tipo_veiculo',
        'marca_modelo_veiculo',
        'placa_veiculo',
        'renavam',
        'passageiros',
        'lista_passageiros',
        'data_chegada',
        'hora_chegada',
        'data_saida',
        'hora_saida',
        'observacao',
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

    public function organizador()
    {
        return $this->belongsTo(Organizadores::class, 'organizador_id');
    }

    public function alteradoPor()
    {
        return $this->belongsTo(User::class, 'alterado_por');
    }

    public function getListaPassageirosSanitizedAttribute(): string
    {
        return html_entity_decode(strip_tags((string) ($this->lista_passageiros ?? '')), ENT_QUOTES, 'UTF-8');
    }

    public static function statusOptions(): array
    {
        return [
            'aguardando' => 'Aguardando',
            'em análise' => 'Em Análise',
            'liberado' => 'Liberado',
            'recusado' => 'Recusado',
        ];
    }

    public static function motivoVisitaOptions(): array
    {
        return [
            'turistico' => 'Turístico',
            'educacional' => 'Educacional',
            'religioso' => 'Religioso',
            'profissional' => 'Profissional',
            'outros' => 'Outros',
        ];
    }

    public static function tipoVeiculoOptions(): array
    {
        return [
            'onibus' => 'Ônibus',
            'micro_onibus' => 'Micro-ônibus',
            'van' => 'Van',
            'carro' => 'Carro',
        ];
    }

    public static function destinoOptions(): array
    {
        return [
            'jacareí' => 'Conceição de Jacareí',
            'itacuruca' => 'Itacuruça',
            'mangaratiba' => 'Mangaratiba',
            'muriqui' => 'Muriqui',
            'praia_Grande' => 'Praia Grande',
        ];
    }
}
