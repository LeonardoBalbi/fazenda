<?php
namespace App\Filament\Resources\TransportadorasResource\Pages;
use App\Filament\Resources\TransportadorasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListTransportadoras extends ListRecords {
    protected static string $resource = TransportadorasResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
