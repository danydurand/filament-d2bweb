<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = 'Category';

    protected static ?string $navigationGroup = 'System Management';
    protected static ?int $navigationSort = 5;



    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                TextInput::make('code')
                    ->maxLength(6)
                    ->required(),
                TextInput::make('description')
                    ->maxLength(100)
                    ->required(),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id'),
            TextColumn::make('description')
                ->sortable()
                ->searchable(),
            TextColumn::make('lines_count')
                ->label('Lines')
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
            RelationManagers\LinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
