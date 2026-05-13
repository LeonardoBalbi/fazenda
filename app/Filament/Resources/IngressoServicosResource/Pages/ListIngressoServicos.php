<?php
namespace App\Filament\Resources\IngressoServicosResource\Pages;
use App\Filament\Resources\IngressoServicosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListIngressoServicos extends ListRecords {
    protected static string $resource = IngressoServicosResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
