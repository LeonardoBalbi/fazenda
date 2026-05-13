<?php

namespace App\Filament\Resources\PasseiosTuristicosResource\Pages;

use App\Filament\Resources\PasseiosTuristicosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPasseiosTuristicos extends ListRecords
{
    protected static string $resource = PasseiosTuristicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Criar Passeio Turístico'),
        ];
    }
}
