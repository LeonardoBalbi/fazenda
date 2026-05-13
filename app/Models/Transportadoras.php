<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadoras extends Model
{
    use HasFactory;

    protected $table = 'transportadoras';

    protected $fillable = [
        'status',
        'nome',
        'cpf_cnpj',
        'numero_cadastro_turismo',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'email',
    ];

    public function passeios()
    {
        return $this->hasMany(PasseiosTuristicos::class, 'transportadoras_id');
    }
}
