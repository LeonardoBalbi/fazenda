<?php

namespace App\Support;

final class SeloIngressoEspecial
{
    /**
     * Nº da autorização no formato do selo especial (ano + id 3 dígitos + "S").
     */
    public static function mascararAutorizacaoId(int|string $id): string
    {
        return sprintf('%d%03d%s', (int) date('Y'), (int) $id, 'S');
    }

    public static function isLiberado(?string $status): bool
    {
        return mb_strtolower(trim((string) $status), 'UTF-8') === 'liberado';
    }
}
