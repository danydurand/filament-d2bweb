<?php

namespace App\Filament\Resources\CustomerTypeResource\Pages;

use App\Filament\Resources\CustomerTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomerType extends EditRecord
{
    protected static string $resource = CustomerTypeResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['code'] = strtoupper($data['code']);
        $data['description'] = strtoupper($data['description']);
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
