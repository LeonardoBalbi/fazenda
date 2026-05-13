<?php
namespace App\Filament\Resources\TransportadorasResource\Pages;
use App\Filament\Resources\TransportadorasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditTransportadoras extends EditRecord {
    protected static string $resource = TransportadorasResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
