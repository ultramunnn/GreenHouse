<?php

namespace App\Filament\Resources\DeviceKategoryResource\Pages;

use App\Filament\Resources\DeviceKategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeviceKategory extends CreateRecord
{
    protected static string $resource = DeviceKategoryResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list setelah create selesai
        return $this->getResource()::getUrl('index');
    }
}
