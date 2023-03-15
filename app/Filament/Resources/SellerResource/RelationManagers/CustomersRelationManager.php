<?php

namespace App\Filament\Resources\SellerResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;


class CustomersRelationManager extends RelationManager
{
    protected static string $relationship = 'customers';
    protected static ?string $modelLabel = 'Customer';

    protected static ?string $recordTitleAttribute = 'business_name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('code')
                        ->maxLength(6)
                        ->required(),
                    TextInput::make('fiscal_number')
                        ->maxLength(30)
                        ->required(),
                    TextInput::make('business_name')
                        ->maxLength(100)
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
                    TextInput::make('phones')
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
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fiscal_number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('business_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('contact_name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
