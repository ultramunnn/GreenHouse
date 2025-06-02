<?php

namespace App\Filament\Resources\DeviceKategoryResource\Pages;

use App\Filament\Resources\DeviceKategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeviceKategories extends ListRecords
{
    protected static string $resource = DeviceKategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->createAnother(false),
        ];
    }
}
