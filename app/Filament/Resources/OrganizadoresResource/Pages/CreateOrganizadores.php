<?php
namespace App\Filament\Resources\OrganizadoresResource\Pages;
use App\Filament\Resources\OrganizadoresResource;
use Filament\Resources\Pages\CreateRecord;
class CreateOrganizadores extends CreateRecord {
    protected static string $resource = OrganizadoresResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
