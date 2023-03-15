<?php

namespace App\Filament\Resources\CustomerTypeResource\Pages;

use App\Filament\Resources\CustomerTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomerType extends CreateRecord
{
    protected static string $resource = CustomerTypeResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['code'] = strtoupper($data['code']);
        $data['description'] = strtoupper($data['description']);
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}
