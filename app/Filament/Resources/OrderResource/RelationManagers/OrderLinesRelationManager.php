<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Article;
use App\Models\Order;
use App\Models\OrderLine;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;


class OrderLinesRelationManager extends RelationManager
{
    protected static string $relationship = 'orderLines';
    protected static ?string $modelLabel = 'Item';
    protected static ?string $title = 'Items';
    protected static ?string $recordTitleAttribute = 'line_number';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    Hidden::make('line_number')
                        ->disabled(),
                    Select::make('article_id')
                        ->label('Acticle')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $article = Article::find($state);
                            if ($article) {
                                $set('sale_price', $article->sale_price1);
                                $set('sale_price2', $article->sale_price1);
                            }
                        })
                        ->relationship('article', 'description'),
                    Select::make('warehouse_id')
                        ->label('Warehouse')
                        ->required()
                        ->relationship('warehouse', 'description'),
                    TextInput::make('qty')
                        ->numeric()
                        ->required(),
                    TextInput::make('sale_price')
                        ->numeric()
                        ->required(),
                    Hidden::make('sale_price2')
                        ->disabled()
                ])
            ])
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('line_number')
                //     ->sortable()
                //     ->searchable(),
                Split::make([
                    TextColumn::make('article.short_desc')
                        ->sortable()
                        ->alignCenter()
                        ->searchable(),
                    TextColumn::make('qty')
                        ->alignCenter()
                        ->sortable(),
                    TextColumn::make('sale_price')
                        ->alignCenter()
                        ->label('Sale Price'),
                    TextColumn::make('net_amount')
                        ->alignCenter()
                        ->label('Net Amount'),
                ])->from('md')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->using(function (CreateAction $action, RelationManager $livewire, array $data) {
                        $order = $livewire->ownerRecord;
                        $data['line_number'] = $order->order_lines_count + 1;
                        $data['created_by']  = auth()->id();
                        $data['updated_by']  = auth()->id();
                        $data['net_amount']  = $data['qty'] * $data['sale_price'];
                        return $action->getRelationship()->create($data);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['updated_by'] = auth()->id();
                        $data['net_amount'] = $data['qty'] * $data['sale_price'];

                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
