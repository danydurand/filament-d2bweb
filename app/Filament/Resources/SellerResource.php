<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellerResource\Pages;
use App\Filament\Resources\SellerResource\RelationManagers;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Seller';
    protected static ?string $navigationGroup = 'Tables';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->required(),
                        TextInput::make('sales_commission')
                            ->required(),
                        TextInput::make('collect_commission')
                            ->required(),
                        TextInput::make('login')
                            ->required(),
                        TextInput::make('password')
                            ->password()
                            ->required(),
                        DatePicker::make('last_login_date')
                            ->disabled(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(),
                TextInputColumn::make('name')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('sales_commission')
                    ->toggleable()
                    ->label('Sales Comm')
                    ->sortable(),
                TextColumn::make('collect_commission')
                    ->toggleable()
                    ->label('Collect Comm')
                    ->sortable(),
                TextColumn::make('login')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                BadgeColumn::make('customers_count')
                    ->label('Customers')
                    ->alignCenter()
                    ->colors(['success'])
                    ->sortable(),
                TextColumn::make('last_login_date')
                    ->toggleable()
                    ->dateTime()
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->toggleable()
                    ->dateTime("Y-m-d H:i")
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->toggleable()
                    ->dateTime("Y-m-d H:i")
                    ->alignCenter()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CustomersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSellers::route('/'),
            'create' => Pages\CreateSeller::route('/create'),
            'edit' => Pages\EditSeller::route('/{record}/edit'),
        ];
    }
}
