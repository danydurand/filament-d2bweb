<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $data['code'] = strtoupper($data['code']);
        $data['fiscal_number'] = strtoupper($data['fiscal_number']);
        $data['business_name'] = strtoupper($data['business_name']);
        $data['fiscal_address'] = strtoupper($data['fiscal_address']);
        $data['dispatch_address'] = strtoupper($data['dispatch_address']);
        $data['contact_name'] = strtoupper($data['contact_name']);
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}
