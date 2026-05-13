<?php

namespace App\Http\Controllers;

use App\Models\PasseiosTuristicos;
use App\Support\SeloTurismo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasseioTurismoSeloPrintController extends Controller
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

        $passeios = PasseiosTuristicos::query()
            ->with(['transportadora', 'organizador', 'alteradoPor'])
            ->whereIn('id', $ids)
            ->orderBy('id')
            ->get();

        abort_if($passeios->count() !== $ids->count(), 404);

        foreach ($passeios as $passeio) {
            abort_unless(SeloTurismo::isLiberado($passeio->status), 403, 'Apenas passeios com status Liberado.');
        }

        $dataEmissao = Carbon::now();

        return view('passeios.selos-print', [
            'passeios' => $passeios,
            'dataEmissao' => $dataEmissao,
        ]);
    }
}
