<?php

use App\Http\Controllers\IngressoEspecialSeloPrintController;
use App\Http\Controllers\PasseioTurismoSeloPrintController;
use App\Http\Controllers\SeloEspecialPublicController;
use App\Http\Controllers\SeloTuristicoPublicController;
use Illuminate\Support\Facades\Route;

Route::get('/selo_turistico/{token}', SeloTuristicoPublicController::class)->name('selo_turistico.public');
Route::get('/selo_especial/{token}', SeloEspecialPublicController::class)->name('selo_especial.public');

Route::middleware('auth')->group(function (): void {
    Route::get('/passeios-turisticos/selos/impressao', PasseioTurismoSeloPrintController::class)
        ->name('passeios.selos.impressao');
    Route::get('/ingresso-especial/selos/impressao', IngressoEspecialSeloPrintController::class)
        ->name('ingresso-especial.selos.impressao');
});

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');
