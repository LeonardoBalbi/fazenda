<?php

namespace App\Http\Controllers;

use App\Models\IngressoServicos;
use App\Support\SeloIngressoServico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IngressoServicoSeloPrintController extends Controller
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

        $registos = IngressoServicos::query()
            ->with(['transportadora', 'alteradoPor'])
            ->whereIn('id', $ids)
            ->orderBy('id')
            ->get();

        abort_if($registos->count() !== $ids->count(), 404);

        foreach ($registos as $registo) {
            abort_unless(SeloIngressoServico::isLiberado($registo->status), 403, 'Apenas ingressos de serviço com status Liberado.');
        }

        $dataEmissao = Carbon::now();

        return view('ingresso-servicos.selos-print', [
            'registos' => $registos,
            'dataEmissao' => $dataEmissao,
        ]);
    }
}
