<?php

namespace App\Filament\Resources\PasseiosTuristicosResource\Pages;

use App\Filament\Resources\PasseiosTuristicosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPasseiosTuristicos extends EditRecord
{
    protected static string $resource = PasseiosTuristicosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['alterado_por'] = auth()->id();
        return $data;
    }
}
