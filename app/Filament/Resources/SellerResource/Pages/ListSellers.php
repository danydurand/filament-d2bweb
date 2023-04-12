<?php
namespace App\Filament\Resources\SellerResource\Pages;

use App\Filament\Resources\SellerResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListSellers extends ListRecords
{
    protected static string $resource = SellerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()->exports([
                ExcelExport::make('table')->fromTable(),
            ])
        ];
    }

}
