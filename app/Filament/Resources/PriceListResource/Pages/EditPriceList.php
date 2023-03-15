<?php

namespace App\Filament\Resources\PriceListResource\Pages;

use App\Filament\Resources\PriceListResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPriceList extends EditRecord
{
    protected static string $resource = PriceListResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['name'] = strtoupper($data['name']);
        $data['updated_by'] = auth()->id();

        $record->update($data);

        return $record;
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
