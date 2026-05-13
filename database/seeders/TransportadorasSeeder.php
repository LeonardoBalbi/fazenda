<?php

namespace Database\Seeders;

use App\Models\Transportadoras;
use Illuminate\Database\Seeder;

class TransportadorasSeeder extends Seeder
{
    public function run(): void
    {
        $transportadoras = [
            ['nome'=>'COOPER AGUIA COOPERATIVA DE TRANSPORTE TURISMO FRETAMENTO E LOCAÇÃO LTDA','cpf_cnpj'=>'30.465.848/0001-57','numero_cadastro_turismo'=>'30465848000157','endereco'=>'AV. OLOF PALME','numero'=>'765','complemento'=>'SALA 620','bairro'=>'CAMORIM','cidade'=>'RIO DE JANEIRO','estado'=>'RIO DE JANEIRO','cep'=>'22-783-119','telefone'=>'(21)27719-988','email'=>'MGPK23@GMAIL.COM','status'=>'aprovado'],
            ['nome'=>'RIO ALEGRIA TOUR','cpf_cnpj'=>'11.415.793/0001-26','numero_cadastro_turismo'=>'34420204000165','endereco'=>'AV. NSR. DE COPACABANA','numero'=>'435','complemento'=>'LOJA','bairro'=>'COPACABANA','cidade'=>'RIO DE JANEIRO','estado'=>'RIO DE JANEIRO','cep'=>'22-020-002','telefone'=>'(21)97139-6402','email'=>'ALEGRIA@ALEGRIATOUR.COM.BR','status'=>'aprovado'],
            ['nome'=>'EVANIL TRANSPORTES E TURISMO LTDA','cpf_cnpj'=>'30.751.572/0001-73','numero_cadastro_turismo'=>'30.751.572/0001-73','endereco'=>'RUA FREDERICO DE CASTRO PEREIRA','numero'=>'900','complemento'=>'0','bairro'=>'MONTE LIBANO','cidade'=>'NOVA IGUACU','estado'=>'RIO DE JANEIRO','cep'=>'26-015-060','telefone'=>'(21)31258-700','email'=>'TURISMO@EVANIL.COM.BR','status'=>'aprovado'],
            ['nome'=>'LAD TRANSPORTES LTDA','cpf_cnpj'=>'14.481.813/0001-55','numero_cadastro_turismo'=>'14.481.813/0001-55','endereco'=>'RUA MANACAPURU','numero'=>'69','complemento'=>'PARTE','bairro'=>'CAMPO GRANDE','cidade'=>'RIO DE JANEIRO','estado'=>'RIO DE JANEIRO','cep'=>'23-016-130','telefone'=>'(21)35936-927','email'=>'IBBTURISMO@HOTMAIL.COM','status'=>'aprovado'],
            ['nome'=>'LMD TUR TURISMO LTDA','cpf_cnpj'=>'36.043.877/0001-07','numero_cadastro_turismo'=>'36043877000107','endereco'=>'RUA PAULO PEREIRA','numero'=>'48','complemento'=>'LOTE 03','bairro'=>'SENADOR CAMARA','cidade'=>'RIO DE JANEIRO','estado'=>'RIO DE JANEIRO','cep'=>'21-831-008','telefone'=>'(21)97854-6484','email'=>'LMD.TURISMO@OUTLOOK.COM','status'=>'aprovado'],
        ];

        foreach ($transportadoras as $t) {
            Transportadoras::create($t);
        }
    }
}
