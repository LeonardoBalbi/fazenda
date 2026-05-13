<?php
namespace App\Filament\Resources\IngressoEspecialResource\Pages;
use App\Filament\Resources\IngressoEspecialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListIngressoEspecial extends ListRecords {
    protected static string $resource = IngressoEspecialResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
