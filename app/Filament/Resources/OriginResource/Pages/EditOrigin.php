<?php

namespace App\Filament\Resources\OriginResource\Pages;

use App\Filament\Resources\OriginResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditOrigin extends EditRecord
{
    protected static string $resource = OriginResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['description'] = strtoupper($data['description']);
        $data['updated_by']  = auth()->id();

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
