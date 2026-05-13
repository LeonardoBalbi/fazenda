<?php

use App\Http\Controllers\IngressoEspecialSeloPrintController;
use App\Http\Controllers\IngressoServicoSeloPrintController;
use App\Http\Controllers\PasseioTurismoSeloPrintController;
use App\Http\Controllers\SeloEspecialPublicController;
use App\Http\Controllers\SeloServicoPublicController;
use App\Http\Controllers\SeloTuristicoPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/selo_turistico/{token}', SeloTuristicoPublicController::class)->name('selo_turistico.public');
Route::get('/selo_especial/{token}', SeloEspecialPublicController::class)->name('selo_especial.public');
Route::get('/selo_servico/{token}', SeloServicoPublicController::class)->name('selo_servico.public');

Route::middleware('auth')->group(function (): void {
    Route::get('/passeios-turisticos/selos/impressao', PasseioTurismoSeloPrintController::class)
        ->name('passeios.selos.impressao');
    Route::get('/ingresso-especial/selos/impressao', IngressoEspecialSeloPrintController::class)
        ->name('ingresso-especial.selos.impressao');
    Route::get('/ingresso-servicos/selos/impressao', IngressoServicoSeloPrintController::class)
        ->name('ingresso-servicos.selos.impressao');
});

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');
