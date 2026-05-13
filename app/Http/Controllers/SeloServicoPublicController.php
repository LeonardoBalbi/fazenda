<?php

namespace App\Http\Controllers;

use App\Models\IngressoServicos;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeloServicoPublicController extends Controller
{
    public function __invoke(Request $request, string $token): View
    {
        $decoded = base64_decode($token, true);
        $id = is_numeric($decoded) ? (int) $decoded : 0;
        abort_if($id < 1, 404);

        $registo = IngressoServicos::query()
            ->with(['transportadora'])
            ->findOrFail($id);

        return view('ingresso-servicos.selo-publico', [
            'registo' => $registo,
        ]);
    }
}
