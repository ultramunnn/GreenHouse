<?php

namespace App\Filament\Resources\DevicesResource\Pages;

use App\Filament\Resources\DevicesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDevices extends CreateRecord
{
    protected static string $resource = DevicesResource::class;
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list setelah create selesai
        return $this->getResource()::getUrl('index');
    }

}
