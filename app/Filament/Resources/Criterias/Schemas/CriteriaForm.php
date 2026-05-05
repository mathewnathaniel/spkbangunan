<?php

namespace App\Filament\Resources\Criterias\Schemas;

use Filament\Schemas\Schema;

class CriteriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama Kriteria')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\Select::make('type')
                    ->label('Tipe Kriteria')
                    ->options([
                        'benefit' => 'Benefit',
                        'cost' => 'Cost',
                    ])
                    ->required()
                    ->default('benefit'),
            ]);
    }
}
