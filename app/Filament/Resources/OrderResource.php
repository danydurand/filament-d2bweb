<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Article;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Placeholder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';
    protected static ?string $modelLabel = 'Order';
    protected static ?string $navigationGroup = 'Orders';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('number')
                        ->disabled(),
                    Select::make('customer_id')
                        ->label('Customer')
                        ->required()
                        ->relationship('customer', 'business_name'),
                    Select::make('seller_id')
                        ->label('Seller')
                        ->required()
                        ->relationship('seller', 'name'),
                    Select::make('transport_id')
                        ->label('Transport')
                        ->required()
                        ->relationship('transport', 'name'),
                    DatePicker::make('order_date')
                        ->required(),
                    Select::make('payment_condition_id')
                        ->label('Payment Condition')
                        ->required()
                        ->relationship('paymentCondition', 'description'),
                ]),
            ]),
            // Card::make()->schema([
            //     Repeater::make('orderLines')
            //         ->relationship()
            //         ->schema([
            //             Grid::make()->schema([
            //                 Select::make('article_id')
            //                     ->label('Article')
            //                     ->required()
            //                     ->reactive()
            //                     ->afterStateUpdated(function ($state, callable $set) {
            //                         $article = Article::find($state);
            //                         if ($article) {
            //                             $set('sale_price', $article->sale_price1);
            //                             $set('sale_price2', $article->sale_price1);
            //                         }
            //                     })
            //                     ->relationship('article', 'description'),
            //                 Select::make('warehouse_id')
            //                     ->label('Warehouse')
            //                     ->required()
            //                     ->relationship('warehouse', 'description'),
            //                 TextInput::make('qty')
            //                     ->numeric()
            //                     ->required(),
            //                 TextInput::make('sale_price')
            //                     ->disabled()
            //                     ->numeric()
            //                     ->required(),
            //                 TextInput::make('sale_price2')
            //                     ->disabled(),
            //                 TextInput::make('line_number')
            //                     ->numeric()
            //                     ->disabled(),
            //             ])
            //         ])
            //         ->defaultItems(1)
            //         ->columnSpan('full')
            //         ->createItemButtonLabel('Add Article')
            // ])
        ]);
    }

    // protected function mutateRelationshipDataBeforeCreate($data): array
    // {
    //     info('Mutating relationship before create: '. print_r($data, true));

    //     return $data;
    // }

    // protected function mutateRelationshipDataBeforeSave($data): array
    // {
    //     info('Mutating relationship before save: '. print_r($data, true));

    //     return $data;
    // }

    public static function table(Table $table): table
    {
        return $table
            ->columns([
                // Split::make([
                    TextColumn::make('number')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('customer.business_name')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('seller.name')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('status')
                        ->searchable()
                        ->alignCenter()
                        ->sortable(),
                    TextColumn::make('order_date')
                        ->label('Order Date')
                        ->dateTime("Y-m-d")
                        ->alignCenter()
                        ->sortable(),
                    // TextColumn::make('created_at')
                    //     ->label('Created At')
                    //     ->dateTime("Y-m-d H:i")
                    //     ->alignCenter()
                    //     ->sortable(),
                // ])
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderLinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
