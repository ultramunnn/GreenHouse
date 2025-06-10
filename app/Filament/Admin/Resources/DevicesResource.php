<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DevicesResource\Pages;
use App\Filament\Admin\Resources\DevicesResource\RelationManagers;
use App\Models\Devices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

/**
 * Resource Devices
 * Mengelola tampilan dan operasi CRUD untuk perangkat
 * Digunakan di panel admin untuk mengelola data perangkat yang terdaftar
 */
class DevicesResource extends Resource
{
    protected static ?string $model = Devices::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('nama_device')->label('Nama Device')->sortable()->searchable(),
                TextColumn::make('kategori.nama_kategori')->label('Kategori Device'),
                TextColumn::make('keterangan')->label('Keterangan')->limit(50),
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
        return $form
            ->schema([
                TextInput::make('nama_device')
                    ->label('Nama Device')
                    ->required()
                    ->maxLength(255),


                Select::make('masterkategori_device_id')
                    ->label('Kategori Device')
                    ->relationship('kategori', 'nama_kategori') // Pastikan relasi 'kategori' di model Devices sudah benar
                    ->required(),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->nullable()
                    ->maxLength(65535),

            ]);
    }

    //setelah create selesai langsung buka tabel
    protected function getRedirectUrl(): string
    {
        // Setelah create selesai, redirect ke halaman list
        return $this->getResource()::getUrl('DevicesResource.php');
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
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevices::route('/create'),
            'edit' => Pages\EditDevices::route('/{record}/edit'),
        ];
    }
}
