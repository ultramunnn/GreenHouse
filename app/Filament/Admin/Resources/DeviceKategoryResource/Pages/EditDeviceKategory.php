<?php

namespace App\Filament\Admin\Resources\DeviceKategoryResource\Pages;

use App\Filament\Admin\Resources\DeviceKategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeviceKategory extends EditRecord
{
    protected static string $resource = DeviceKategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
