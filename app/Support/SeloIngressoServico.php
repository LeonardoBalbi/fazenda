<?php

namespace App\Support;

final class SeloIngressoServico
{
    public static function mascararAutorizacaoId(int|string $id): string
    {
        return sprintf('%d%03d%s', (int) date('Y'), (int) $id, 'S');
    }

    public static function isLiberado(?string $status): bool
    {
        return mb_strtolower(trim((string) $status), 'UTF-8') === 'liberado';
    }

    /** Cor da faixa vertical conforme destino; destinos não mapeados usam #070606 (selo serviços). */
    public static function corBarraDestino(?string $destino): string
    {
        $key = mb_strtolower(trim((string) $destino), 'UTF-8');

        return match ($key) {
            'muriqui' => '#A6CE39',
            'jacareí', 'jacarei' => '#ffae00',
            'praia_grande', 'praiagrande' => '#00bbff',
            'itacuruca' => '#FF0000',
            'mangaratiba' => '#ad6f1d',
            default => '#070606',
        };
    }
}
