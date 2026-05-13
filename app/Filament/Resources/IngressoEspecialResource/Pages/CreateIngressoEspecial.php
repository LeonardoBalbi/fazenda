<?php
namespace App\Filament\Resources\IngressoEspecialResource\Pages;
use App\Filament\Resources\IngressoEspecialResource;
use Filament\Resources\Pages\CreateRecord;
class CreateIngressoEspecial extends CreateRecord {
    protected static string $resource = IngressoEspecialResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
