<?php

namespace App\Filament\Resources\Brands;

use App\Filament\Resources\Brands\Pages\CreateBrand;
use App\Filament\Resources\Brands\Pages\EditBrand;
use App\Filament\Resources\Brands\Pages\ListBrands;
use App\Models\Brand;
use App\Models\Category;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $navigationLabel = 'Brand';

    protected static ?string $pluralLabel = 'Brand';

    protected static ?string $modelLabel = 'Brand';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('category_id')
                ->label('Kategori')
                ->options(Category::all()->pluck('name', 'id'))
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('name')
                ->label('Nama Brand')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('satuan')
                ->label('Satuan')
                ->maxLength(255),

            Forms\Components\FileUpload::make('image')
                ->label('Gambar Brand')
                ->image()
                ->disk('public')
                ->directory('brands')
                ->maxSize(5120),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Brand')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('satuan')
                    ->label('Satuan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('score.harga')
                    ->label('Harga')
                    ->numeric(2)
                    ->default('-'),

                Tables\Columns\TextColumn::make('score.kualitas')
                    ->label('Kualitas')
                    ->numeric(2)
                    ->default('-'),

                Tables\Columns\TextColumn::make('score.minat_pasar')
                    ->label('Minat Pasar')
                    ->numeric(2)
                    ->default('-'),

                Tables\Columns\TextColumn::make('rankingResult.ranking')
                    ->label('Ranking')
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state === 1 => 'success',
                        $state === 2 => 'warning',
                        $state === 3 => 'info',
                        default      => 'gray',
                    })
                    ->default('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->options(Category::all()->pluck('name', 'id')),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit'   => EditBrand::route('/{record}/edit'),
        ];
    }
}
