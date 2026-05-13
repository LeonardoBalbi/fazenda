<?php
namespace App\Filament\Resources\IngressoServicosResource\Pages;
use App\Filament\Resources\IngressoServicosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditIngressoServicos extends EditRecord {
    protected static string $resource = IngressoServicosResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
