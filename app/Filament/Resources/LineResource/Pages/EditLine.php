<?php

namespace App\Filament\Resources\LineResource\Pages;

use App\Filament\Resources\LineResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditLine extends EditRecord
{
    protected static string $resource = LineResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
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
