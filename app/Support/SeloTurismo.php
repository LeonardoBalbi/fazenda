<?php

namespace App\Support;

final class SeloTurismo
{
    public static function mascararId(int|string $id): string
    {
        return sprintf('%s%04d', date('Y'), (int) $id);
    }

    public static function corFundoParaDestino(?string $destino): string
    {
        $key = mb_strtolower((string) $destino, 'UTF-8');

        return match ($key) {
            'muriqui' => '#A6CE39',
            'jacareí', 'jacarei' => '#ffae00',
            'praia_grande', 'praiagrande' => '#00bbff',
            'itacuruca' => '#FF0000',
            'mangaratiba' => '#ad6f1d',
            default => '#A6CE39',
        };
    }

    public static function isLiberado(?string $status): bool
    {
        return mb_strtolower(trim((string) $status), 'UTF-8') === 'liberado';
    }
}
