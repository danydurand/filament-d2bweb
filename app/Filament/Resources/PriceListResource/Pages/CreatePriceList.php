<?php

namespace App\Filament\Resources\PriceListResource\Pages;

use App\Filament\Resources\PriceListResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePriceList extends CreateRecord
{
    protected static string $resource = PriceListResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['name'] = strtoupper($data['name']);
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
