<?php

namespace App\Filament\Resources\Suppliers;

use App\Filament\Resources\Suppliers\Pages;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Suppliers';

    protected static ?string $pluralLabel = 'Suppliers';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')
                ->label('Nama Supplier')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('phone')
                ->label('No HP')
                ->tel(),

            Forms\Components\Textarea::make('address')
                ->label('Alamat')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Supplier')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('No HP'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y'),
            ])
            ->filters([])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}