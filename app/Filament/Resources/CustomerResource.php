<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;


class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'Customer';
    protected static ?string $navigationGroup = 'Orders';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('code')
                        ->maxLength(6)
                        ->required(),
                    TextInput::make('business_name')
                        ->maxLength(100)
                        ->required(),
                    TextInput::make('fiscal_number')
                        ->maxLength(30)
                        ->required(),
                    Select::make('customer_type_id')
                        ->label('Type')
                        ->required()
                        ->relationship('customer_type', 'description'),
                    Select::make('seller_id')
                        ->label('Seller')
                        ->required()
                        ->relationship('seller', 'name'),
                    TextInput::make('contact_name')
                        ->maxLength(60)
                        ->required(),
                    Textarea::make('fiscal_address')
                        ->maxLength(250)
                        ->rows(2)
                        ->required(),
                    Textarea::make('dispatch_address')
                        ->maxLength(250)
                        ->rows(2)
                        ->required(),
                    TextInput::make('phones')
                        ->maxLength(60)
                        ->required(),
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('business_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fiscal_number')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('contact_name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('seller.name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('phones')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime("Y-m-d H:i")
                    ->alignCenter()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
