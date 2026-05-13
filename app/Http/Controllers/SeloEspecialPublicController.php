<?php

namespace App\Http\Controllers;

use App\Models\IngressoEspecial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeloEspecialPublicController extends Controller
{
    public function __invoke(Request $request, string $token): View
    {
        $decoded = base64_decode($token, true);
        $id = is_numeric($decoded) ? (int) $decoded : 0;
        abort_if($id < 1, 404);

        $registo = IngressoEspecial::query()
            ->with(['transportadora'])
            ->findOrFail($id);

        return view('ingresso-especial.selo-publico', [
            'registo' => $registo,
        ]);
    }
}
