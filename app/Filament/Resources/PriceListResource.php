<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceListResource\Pages;
use App\Filament\Resources\PriceListResource\RelationManagers;
use App\Models\PriceList;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceListResource extends Resource
{
    protected static ?string $model = PriceList::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';
    protected static ?string $navigationGroup = 'Tables';
    protected static ?string $modelLabel = 'Price Lists';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->maxLength(50)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customer_types_count')
                    ->label('Customer Types')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime("Y-m-d H:i:s")
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime("Y-m-d H:i:s")
                    ->alignCenter()
                    ->sortable(),
                // TextColumn::make('must_be_sync')
                //     ->label('Must Be Sync')
                //     ->alignCenter()
                //     ->sortable(),
                // TextColumn::make('sync_at')
                //     ->dateTime()
                //     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPriceLists::route('/'),
            'create' => Pages\CreatePriceList::route('/create'),
            'edit' => Pages\EditPriceList::route('/{record}/edit'),
        ];
    }
}
