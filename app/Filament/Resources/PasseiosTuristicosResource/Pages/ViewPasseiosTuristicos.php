<?php

namespace App\Filament\Resources\PasseiosTuristicosResource\Pages;

use App\Filament\Resources\PasseiosTuristicosResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPasseiosTuristicos extends ViewRecord
{
    protected static string $resource = PasseiosTuristicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
