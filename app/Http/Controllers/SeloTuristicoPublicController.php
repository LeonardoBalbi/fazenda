<?php

namespace App\Http\Controllers;

use App\Models\PasseiosTuristicos;
use App\Support\SeloTurismo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeloTuristicoPublicController extends Controller
{
    public function __invoke(Request $request, string $token): View
    {
        $decoded = base64_decode($token, true);
        $id = is_numeric($decoded) ? (int) $decoded : 0;
        abort_if($id < 1, 404);

        $selo = PasseiosTuristicos::query()
            ->with(['transportadora', 'organizador'])
            ->findOrFail($id);

        $dataEmissao = now();

        return view('passeios.selo-publico', [
            'selo' => $selo,
            'dataEmissao' => $dataEmissao,
            'corFundo' => SeloTurismo::corFundoParaDestino($selo->destino),
        ]);
    }
}
