<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSpaceResource\Pages;
use App\Filament\Resources\OfficeSpaceResource\RelationManagers;
use App\Models\OfficeSpace;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->placeholder('Masukkan Nama Office Space')
                ->required()
                ->maxLength(255),

                TextInput::make('address')
                ->required()
                ->placeholder('Masukkan Alamat')
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->image()
                ->required(),

                Textarea::make('about')
                ->required()
                ->rows(10)
                ->cols(20),
                
                Repeater::make('photos')	
                ->relationship('photos')
                ->schema([
                    FileUpload::make('photo')
                    ->image()
                    ->required(),
                ]),

                Repeater::make('benefits')	
                ->relationship('benefits')
                ->schema([
                    TextInput::make('name')
                    ->required()
                ]),

                 Select::make('city_id')
                ->relationship('city', 'name')
                ->required()
                ->searchable()
                ->preload(),

                TextInput::make('price')
                ->required()
                ->placeholder('Masukkan Harga') 
                ->numeric()
                ->prefix('Rp. '),

                TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Hari'),

                Select::make('is_open')
                ->options([
                    true => 'Buka',
                    false => 'Tutup',
                ])->required(),

                Select::make('is_full_booked')
                ->options([
                    true => 'Penuh',
                    false => 'Tidak Penuh',
                ])->required()
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                ImageColumn::make('thumbnail')
                ->width(100)->height(100 ),

                TextColumn::make('city.name')
                ->searchable(),

                IconColumn::make('is_full_booked')
                ->boolean()
                ->trueColor('danger')
                ->falseColor('success')
                ->trueIcon('heroicon-o-x-circle')
                ->falseIcon('heroicon-o-check-circle')
                ->label('Ketersediaan'),
            ])
            ->filters([
                SelectFilter::make('city_id')
                ->label('Kota')
                ->relationship('city', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}
