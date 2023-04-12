<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;


    protected function beforeCreate()
    {
        // $lastNumber = Order::max('number');
        // $this->data['number'] = $lastNumber + 1;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // info('mutate data before create: '.print_r($data,true));
        // $data['number'] = 123;

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {

        // $data['description'] = strtoupper($data['description']);
        // dd($data);
        info('handle: '.print_r($data,true));
        $lastNumber = Order::max('number');
        $data['number'] = $lastNumber + 1;

        $data['description'] = strtoupper('description');
        $data['currency_id'] = 1;
        $data['status']      = 'P';
        $data['created_by']  = auth()->id();
        $data['updated_by']  = auth()->id();

        return static::getModel()::create($data);
    }

}
