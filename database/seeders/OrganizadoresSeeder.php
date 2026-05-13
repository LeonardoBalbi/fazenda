<?php

namespace Database\Seeders;

use App\Models\Organizadores;
use Illuminate\Database\Seeder;

class OrganizadoresSeeder extends Seeder
{
    public function run(): void
    {
        $organizadores = [
            ['tipo_cadastro'=>'Pessoa_juridica','cnpj_cpf'=>'68613835000150','razao_social_nome'=>'COSTA VERDE AGÊNCIA DE VIAGENS E TURISMO LTDA','nome_fantasia'=>'COSTA GREEN','cep'=>'23-860-000','endereco'=>'RUA NOSSA SENHORA DA CONCEICÃO','complemento'=>'LOJA','bairro'=>'CONCEIÇÃO DE JACAREÍ','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(21)35550-140','email_responsavel'=>'COSTAGREENTOUR@GMAIL.COM','nome_responsavel'=>'XXXX','telefone_responsavel'=>'(21)00000-0000','status'=>'liberado'],
            ['tipo_cadastro'=>'Pessoa_juridica','cnpj_cpf'=>'07744744000160','razao_social_nome'=>'PORTO LOPES SERVIÇOS E TRANSPORTE MARITIMO LTDA ME','nome_fantasia'=>'PORTO LOPES','cep'=>'23-860-000','endereco'=>'AV. MANGARATIBA','complemento'=>'SOBRADO','bairro'=>'CENTRO','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(21)98480-8597','email_responsavel'=>'CONTATO@HARMONIAASSESSORIA.COM.BR','nome_responsavel'=>'PORTO LOPES','telefone_responsavel'=>'(21)98480-8597','status'=>'liberado'],
            ['tipo_cadastro'=>'Pessoa_juridica','cnpj_cpf'=>'09580009000193','razao_social_nome'=>'FP BARRA TURISMO LTDA','nome_fantasia'=>'FP BARRA','cep'=>'23-885-000','endereco'=>'RUA ADALBERTO PEREIRA PINTO','complemento'=>'64 - B','bairro'=>'CONCEIÇÃO DE JACAREÍ','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(24)33652-739','email_responsavel'=>'fpbarra_turismo@yahoo.com.br','nome_responsavel'=>'Elisangela','telefone_responsavel'=>'(24)33652-739','status'=>'liberado'],
            ['tipo_cadastro'=>'Pessoa_juridica','cnpj_cpf'=>'03993610000121','razao_social_nome'=>'PARAISO VERDE TURISMO LTDA - ME','nome_fantasia'=>'PARAISO VERDE','cep'=>'23-885-000','endereco'=>'RODOVIA RIO SANTOS','complemento'=>'KM 454 - PORTO REAL','bairro'=>'CONCEIÇÃO DE JACAREÍ','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(21)99013-4636','email_responsavel'=>'1@1','nome_responsavel'=>'PARAISO VERDE','telefone_responsavel'=>'(21)99013-4636','status'=>'liberado'],
            ['tipo_cadastro'=>'Pessoa_juridica','cnpj_cpf'=>'29819869000162','razao_social_nome'=>'POUSADA LISAMAR LTDA','nome_fantasia'=>'POUSADA LISAMAR','cep'=>'23-860-000','endereco'=>'RUA PRINCIPAL','complemento'=>'','bairro'=>'CONCEIÇÃO DE JACAREÍ','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(21)99000-0000','email_responsavel'=>'lisamar@lisamar.com.br','nome_responsavel'=>'LISAMAR','telefone_responsavel'=>'(21)99000-0000','status'=>'liberado'],
            ['tipo_cadastro'=>'Pessoa_fisica','cnpj_cpf'=>'00000000000','razao_social_nome'=>'AGÊNCIA SAVEIRO YASMIN','nome_fantasia'=>'SAVEIRO YASMIN','cep'=>'23-860-000','endereco'=>'MARINA','complemento'=>'','bairro'=>'CONCEIÇÃO DE JACAREÍ','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(21)99000-0001','email_responsavel'=>'yasmin@saveirotur.com.br','nome_responsavel'=>'YASMIN','telefone_responsavel'=>'(21)99000-0001','status'=>'liberado'],
            ['tipo_cadastro'=>'Pessoa_fisica','cnpj_cpf'=>'00000000001','razao_social_nome'=>'YURI BARROS GALVAO','nome_fantasia'=>'YURI BARROS','cep'=>'23-860-000','endereco'=>'RUA X','complemento'=>'','bairro'=>'CENTRO','municipio'=>'MANGARATIBA','estado'=>'RIO DE JANEIRO','telefone_celular'=>'(21)99000-0002','email_responsavel'=>'yuri@yuri.com','nome_responsavel'=>'YURI','telefone_responsavel'=>'(21)99000-0002','status'=>'liberado'],
        ];

        foreach ($organizadores as $org) {
            Organizadores::create($org);
        }
    }
}
