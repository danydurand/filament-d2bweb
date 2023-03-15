<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['code'] = strtoupper($data['code']);
        $data['fiscal_number'] = strtoupper($data['fiscal_number']);
        $data['business_name'] = strtoupper($data['business_name']);
        $data['fiscal_address'] = strtoupper($data['fiscal_address']);
        $data['dispatch_address'] = strtoupper($data['dispatch_address']);
        $data['contact_name'] = strtoupper($data['contact_name']);
        $data['updated_by'] = auth()->id();

        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


}
