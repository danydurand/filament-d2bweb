<?php

namespace App\Filament\Resources\ColourResource\Pages;

use App\Filament\Resources\ColourResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateColour extends CreateRecord
{
    protected static string $resource = ColourResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $data['description'] = strtoupper($data['description']);
        $data['created_by']  = auth()->id();
        $data['updated_by']  = auth()->id();

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
