<?php

namespace App\Filament\Resources\BrandScores\Pages;

use App\Filament\Resources\BrandScores\BrandScoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBrandScores extends ListRecords
{
    protected static string $resource = BrandScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
