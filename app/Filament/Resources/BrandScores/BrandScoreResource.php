<?php

namespace App\Filament\Resources\BrandScores;

use App\Filament\Resources\BrandScores\Pages\CreateBrandScore;
use App\Filament\Resources\BrandScores\Pages\EditBrandScore;
use App\Filament\Resources\BrandScores\Pages\ListBrandScores;
use App\Models\Brand;
use App\Models\BrandScore;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class BrandScoreResource extends Resource
{
    protected static ?string $model = BrandScore::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel = 'Penilaian Brand';

    protected static ?string $pluralLabel = 'Penilaian Brand';

    protected static ?string $modelLabel = 'Penilaian Brand';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('brand_id')
                ->label('Brand')
                ->options(Brand::with('category')->get()->mapWithKeys(fn($b) => [
                    $b->id => "[{$b->category?->name}] {$b->name}",
                ]))
                ->required()
                ->searchable()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('harga')
                ->label('Nilai Harga (1-10)')
                ->helperText('Makin rendah harga = makin bagus (kriteria Cost)')
                ->numeric()
                ->required()
                ->minValue(1)
                ->maxValue(10)
                ->step(0.01),

            Forms\Components\TextInput::make('kualitas')
                ->label('Nilai Kualitas (1-10)')
                ->helperText('Makin tinggi = makin bagus (kriteria Benefit)')
                ->numeric()
                ->required()
                ->minValue(1)
                ->maxValue(10)
                ->step(0.01),

            Forms\Components\TextInput::make('minat_pasar')
                ->label('Nilai Minat Pasar (1-10)')
                ->helperText('Makin tinggi = makin diminati (kriteria Benefit)')
                ->numeric()
                ->required()
                ->minValue(1)
                ->maxValue(10)
                ->step(0.01),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('success')
                    ->searchable(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->numeric(2)
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('kualitas')
                    ->label('Kualitas')
                    ->numeric(2)
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('minat_pasar')
                    ->label('Minat Pasar')
                    ->numeric(2)
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
            'index'  => ListBrandScores::route('/'),
            'create' => CreateBrandScore::route('/create'),
            'edit'   => EditBrandScore::route('/{record}/edit'),
        ];
    }
}
