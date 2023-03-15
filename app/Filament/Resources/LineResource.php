<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LineResource\Pages;
use App\Filament\Resources\LineResource\RelationManagers;
use App\Models\Line;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;


class LineResource extends Resource
{
    protected static ?string $model = Line::class;
    protected static ?string $navigationIcon = 'heroicon-o-menu';
    protected static ?string $modelLabel = 'Line';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('description')
                        ->maxLength(100)
                        ->required(),
                    Select::make('category_id')
                        ->label('Category')
                        ->required()
                        ->relationship('category', 'description'),
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('description')
                    ->searchable(),
                TextColumn::make('category.description')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
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
            'index' => Pages\ListLines::route('/'),
            'create' => Pages\CreateLine::route('/create'),
            'edit' => Pages\EditLine::route('/{record}/edit'),
        ];
    }
}
