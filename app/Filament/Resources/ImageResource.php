<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Filament\Resources\ImageResource\RelationManagers;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Webbingbrasil\FilamentCopyActions\Tables\Actions\CopyAction;
use Webbingbrasil\FilamentCopyActions\Tables\CopyableTextColumn;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldSkipAuthorization = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name'),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\FileUpload::make('path')
                    ->required()
                    ->maxSize(1024 * 1024 * 10)
                    ->image()
                    ->imageEditor()
                    ->directory('images'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('client.name')
                    ->sortable()
                    ->searchable()
                    ->label('Cliente'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d/m/Y')
                    ->label('Fecha'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->size('Name')
                    ->label('Nombre'),
                Tables\Columns\ImageColumn::make('path')
                    ->label('Image')
                    ->size('100px')
                    ->label('Imagen'),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(15)
                    ->copyable(),
                CopyableTextColumn::make('shorturl')
                    ->label('Short URL'),
            ])
            ->filters([
                //
            ])
            ->actions([
                CopyAction::make()->copyable(fn ($record) => $record->shorturl),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
