<?php
namespace App\Filament\Resources\TransportadorasResource\Pages;
use App\Filament\Resources\TransportadorasResource;
use Filament\Resources\Pages\CreateRecord;
class CreateTransportadoras extends CreateRecord {
    protected static string $resource = TransportadorasResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
