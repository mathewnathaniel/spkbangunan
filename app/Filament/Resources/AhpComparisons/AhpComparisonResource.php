<?php

namespace App\Filament\Resources\AhpComparisons;

use App\Filament\Resources\AhpComparisons\Pages\CreateAhpComparison;
use App\Filament\Resources\AhpComparisons\Pages\EditAhpComparison;
use App\Filament\Resources\AhpComparisons\Pages\ListAhpComparisons;
use App\Models\AhpComparison;
use App\Models\Criteria;
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

class AhpComparisonResource extends Resource
{
    protected static ?string $model = AhpComparison::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?string $navigationLabel = 'Perbandingan AHP';

    protected static ?string $pluralLabel = 'Perbandingan AHP';

    protected static ?string $modelLabel = 'Perbandingan AHP';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        $criteriaOptions = Criteria::all()->pluck('name', 'id');

        return $schema->components([
            Forms\Components\Select::make('criteria_1_id')
                ->label('Kriteria 1 (Kiri)')
                ->options($criteriaOptions)
                ->required()
                ->searchable(),

            Forms\Components\Select::make('criteria_2_id')
                ->label('Kriteria 2 (Kanan)')
                ->options($criteriaOptions)
                ->required()
                ->searchable(),

            Forms\Components\Select::make('value')
                ->label('Nilai Perbandingan')
                ->helperText('Seberapa penting Kriteria 1 dibandingkan Kriteria 2?')
                ->options([
                    '9' => '9 - Kriteria 1 mutlak lebih penting',
                    '7' => '7 - Kriteria 1 sangat lebih penting',
                    '5' => '5 - Kriteria 1 lebih penting',
                    '3' => '3 - Kriteria 1 sedikit lebih penting',
                    '1' => '1 - Kedua kriteria SAMA penting',
                    '0.3333' => '1/3 - Kriteria 2 sedikit lebih penting',
                    '0.2'    => '1/5 - Kriteria 2 lebih penting',
                    '0.1428' => '1/7 - Kriteria 2 sangat lebih penting',
                    '0.1111' => '1/9 - Kriteria 2 mutlak lebih penting',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('criteria1.name')
                    ->label('Kriteria 1')
                    ->searchable(),

                Tables\Columns\TextColumn::make('criteria2.name')
                    ->label('Kriteria 2')
                    ->searchable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->numeric(4)
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([])
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
            'index'  => ListAhpComparisons::route('/'),
            'create' => CreateAhpComparison::route('/create'),
            'edit'   => EditAhpComparison::route('/{record}/edit'),
        ];
    }
}
