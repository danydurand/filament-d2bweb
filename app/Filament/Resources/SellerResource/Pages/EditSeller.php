<?php

namespace App\Filament\Resources\SellerResource\Pages;

use App\Filament\Resources\SellerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditSeller extends EditRecord
{
    protected static string $resource = SellerResource::class;

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
