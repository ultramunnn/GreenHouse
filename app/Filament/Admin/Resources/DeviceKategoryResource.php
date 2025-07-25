<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DeviceKategoryResource\Pages;
use App\Filament\Admin\Resources\DeviceKategoryResource\RelationManagers;
use App\Models\KategoriDevice as DeviceKategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

/**
 * Resource DeviceKategory
 * Mengelola tampilan dan operasi CRUD untuk kategori perangkat
 * Digunakan di panel admin untuk mengatur kategori-kategori perangkat yang tersedia
 */
class DeviceKategoryResource extends Resource
{
    protected static ?string $model = DeviceKategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('nama_kategori')->label('Nama Kategori')->sortable()->searchable(),
            TextColumn::make('keterangan')->limit(50)->label('Keterangan'),
            TextColumn::make('created_at')->label('Waktu')->dateTime()->sortable(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }



    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama_kategori')
                ->label('Nama Kategori')
                ->required()
                ->maxLength(255),

            Textarea::make('keterangan')
                ->label('Keterangan')
                ->nullable(),
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
            'index' => Pages\ListDeviceKategories::route('/'),
            'create' => Pages\CreateDeviceKategory::route('/create'),
            'edit' => Pages\EditDeviceKategory::route('/{record}/edit'),
        ];
    }
}
