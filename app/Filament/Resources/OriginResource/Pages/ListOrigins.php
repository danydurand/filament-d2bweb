<?php

namespace App\Filament\Resources\OriginResource\Pages;

use App\Filament\Resources\OriginResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrigins extends ListRecords
{
    protected static string $resource = OriginResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
