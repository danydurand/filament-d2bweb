<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $navigationGroup = 'Orders';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make()->schema([
                    TextInput::make('code')
                        ->disabled(),
                    TextInput::make('description')
                        ->disabled(),
                    Select::make('business_id')
                        ->label('Business')
                        ->disabled()
                        ->relationship('business', 'description'),
                    Select::make('brand_id')
                        ->label('Brand')
                        ->disabled()
                        ->relationship('brand', 'description'),
                    Select::make('sub_brand_id')
                        ->label('SubBrand')
                        ->disabled()
                        ->relationship('subBrand', 'description'),
                    Select::make('category_id')
                        ->label('Category')
                        ->disabled()
                        ->relationship('category', 'description'),
                    Select::make('line_id')
                        ->label('Line')
                        ->disabled()
                        ->relationship('line', 'description'),
                    Select::make('sub_line_id')
                        ->label('SubLine')
                        ->disabled()
                        ->relationship('subLine', 'description'),
                    Select::make('colour_id')
                        ->label('Colour')
                        ->disabled()
                        ->relationship('colour', 'description'),
                    Select::make('origin_id')
                        ->label('Origin')
                        ->disabled()
                        ->relationship('origin', 'description'),
                    Select::make('provider_id')
                        ->label('Provider')
                        ->disabled()
                        ->relationship('provider', 'name'),
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('description')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('business.description')
                    ->label('Business')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('brand.description')
                    ->label('Brand')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('category.description')
                    ->label('Category')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('reference')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('model')
                    ->searchable()
                    ->toggleable()
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
