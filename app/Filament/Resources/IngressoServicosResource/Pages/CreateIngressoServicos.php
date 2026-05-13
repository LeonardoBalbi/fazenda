<?php
namespace App\Filament\Resources\IngressoServicosResource\Pages;
use App\Filament\Resources\IngressoServicosResource;
use Filament\Resources\Pages\CreateRecord;
class CreateIngressoServicos extends CreateRecord {
    protected static string $resource = IngressoServicosResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
