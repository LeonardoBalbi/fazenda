<?php

namespace App\Http\Controllers;

use App\Models\IngressoEspecial;
use App\Support\SeloIngressoEspecial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IngressoEspecialSeloPrintController extends Controller
{
    public function __invoke(Request $request): View
    {
        $raw = (string) $request->query('ids', '');
        $ids = collect(explode(',', $raw))
            ->map(fn (string $v): int => (int) trim($v))
            ->filter(fn (int $id): bool => $id > 0)
            ->unique()
            ->values();

        abort_if($ids->isEmpty(), 404);

        $registos = IngressoEspecial::query()
            ->with(['transportadora', 'alteradoPor'])
            ->whereIn('id', $ids)
            ->orderBy('id')
            ->get();

        abort_if($registos->count() !== $ids->count(), 404);

        foreach ($registos as $registo) {
            abort_unless(SeloIngressoEspecial::isLiberado($registo->status), 403, 'Apenas ingressos especiais com status Liberado.');
        }

        $dataEmissao = Carbon::now();

        return view('ingresso-especial.selos-print', [
            'registos' => $registos,
            'dataEmissao' => $dataEmissao,
        ]);
    }
}
