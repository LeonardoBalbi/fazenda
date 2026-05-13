<?php
namespace App\Filament\Resources\AgenciasExternasResource\Pages;
use App\Filament\Resources\AgenciasExternasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditAgenciasExternas extends EditRecord {
    protected static string $resource = AgenciasExternasResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
