<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerTypeResource\Pages;
use App\Filament\Resources\CustomerTypeResource\RelationManagers;
use App\Models\CustomerType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;


class CustomerTypeResource extends Resource
{
    protected static ?string $model = CustomerType::class;
    protected static ?string $navigationIcon = 'heroicon-o-color-swatch';
    protected static ?string $modelLabel = 'Customer Type';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('code')
                        ->maxLength(6)
                        ->required(),
                    TextInput::make('description')
                        ->maxLength(100)
                        ->required(),
                    Select::make('price_list_id')
                        ->label('Price List')
                        ->required()
                        ->relationship('price_list','name'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('description')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price_list.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customers_count')
                    ->label('Customers')
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
            'index' => Pages\ListCustomerTypes::route('/'),
            'create' => Pages\CreateCustomerType::route('/create'),
            'edit' => Pages\EditCustomerType::route('/{record}/edit'),
        ];
    }
}
