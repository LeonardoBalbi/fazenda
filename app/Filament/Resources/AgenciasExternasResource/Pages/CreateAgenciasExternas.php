<?php
namespace App\Filament\Resources\AgenciasExternasResource\Pages;
use App\Filament\Resources\AgenciasExternasResource;
use Filament\Resources\Pages\CreateRecord;
class CreateAgenciasExternas extends CreateRecord {
    protected static string $resource = AgenciasExternasResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
