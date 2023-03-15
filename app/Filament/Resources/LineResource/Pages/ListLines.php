<?php

namespace App\Filament\Resources\LineResource\Pages;

use App\Filament\Resources\LineResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLines extends ListRecords
{
    protected static string $resource = LineResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
