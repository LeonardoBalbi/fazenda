<?php
namespace App\Filament\Resources\AgenciasExternasResource\Pages;
use App\Filament\Resources\AgenciasExternasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListAgenciasExternas extends ListRecords {
    protected static string $resource = AgenciasExternasResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
