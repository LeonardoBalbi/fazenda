<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizadores extends Model
{
    use HasFactory;

    protected $table = 'organizadores';

    protected $fillable = [
        'status',
        'tipo_cadastro',
        'cnpj_cpf',
        'razao_social_nome',
        'nome_fantasia',
        'inscricao_municipal',
        'inscricao_municipal_numero',
        'inscricao_estadual',
        'cep',
        'endereco',
        'complemento',
        'bairro',
        'municipio',
        'estado',
        'telefone_celular',
        'telefone_fixo',
        'email_responsavel',
        'nome_responsavel',
        'telefone_responsavel',
    ];

    public function passeios()
    {
        return $this->hasMany(PasseiosTuristicos::class, 'organizador_id');
    }
}
