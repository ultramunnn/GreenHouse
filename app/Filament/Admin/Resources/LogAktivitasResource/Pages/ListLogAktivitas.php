<?php

namespace App\Filament\Admin\Resources\LogAktivitasResource\Pages;

use App\Filament\Admin\Resources\LogAktivitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogAktivitas extends ListRecords
{
    protected static string $resource = LogAktivitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
