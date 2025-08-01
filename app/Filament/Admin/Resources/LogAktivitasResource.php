<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LogAktivitasResource\Pages;

use Filament\Tables\Columns\TextColumn;
use App\Models\LogAktivitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Resource LogAktivitas
 * Mengelola tampilan dan pencatatan log aktivitas dalam sistem
 * Menampilkan daftar aktivitas dengan detail waktu dan IP address
 */

class LogAktivitasResource extends Resource
{
    protected static ?string $model = LogAktivitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('no')
                ->label('No')
                ->getStateUsing(function ($record, $column, $livewire) {
                    // Hitung index nomor baris di halaman ini
                    return $livewire->getTableRecords()->search(fn($r) => $r->id === $record->id) + 1;
                })
                ->sortable(false),
            TextColumn::make('nama_aktivitas')->searchable()->sortable(),
            TextColumn::make('ip_address')->sortable(),
            TextColumn::make('created_at')
            ->label('Waktu')
            ->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
          
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogAktivitas::route('/'),
            'edit' => Pages\EditLogAktivitas::route('/{record}/edit'),
        ];
    }
}
