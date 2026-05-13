<?php

namespace App\Filament\Resources\PasseiosTuristicosResource\Pages;

use App\Filament\Resources\PasseiosTuristicosResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePasseiosTuristicos extends CreateRecord
{
    protected static string $resource = PasseiosTuristicosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = $data['status'] ?? 'aguardando';
        return $data;
    }
}
