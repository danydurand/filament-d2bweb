<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColourResource\Pages;
use App\Filament\Resources\ColourResource\RelationManagers;
use App\Models\Colour;
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

class ColourResource extends Resource
{
    protected static ?string $model = Colour::class;
    protected static ?string $navigationGroup = 'Tables';
    protected static ?string $modelLabel = 'Colour';


    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('description')
                        ->maxLength(100)
                        ->required(),
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('description')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListColours::route('/'),
            'create' => Pages\CreateColour::route('/create'),
            'edit' => Pages\EditColour::route('/{record}/edit'),
        ];
    }
}
