<?php

namespace App\Filament\Resources\AhpComparisons\Pages;

use App\Filament\Resources\AhpComparisons\AhpComparisonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAhpComparisons extends ListRecords
{
    protected static string $resource = AhpComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
