<?php
namespace App\Filament\Resources\IngressoEspecialResource\Pages;
use App\Filament\Resources\IngressoEspecialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditIngressoEspecial extends EditRecord {
    protected static string $resource = IngressoEspecialResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
