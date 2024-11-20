<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionsResource\Pages;
use App\Filament\Resources\BookingTransactionsResource\RelationManagers;
use App\Models\BookingTransactions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionsResource extends Resource
{
    protected static ?string $model = BookingTransactions::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->placeholder('Masukkan Nama Booking'),

                TextInput::make('phone_number')
                ->numeric()
                ->required()
                ->maxLength(15)
                ->prefix('+62')
                ->placeholder('8123'),

                TextInput::make('booking_trx')
                ->required()
                ->maxLength(255)
                ->placeholder('Masukkan Kode Booking'),

                Select::make('office_space_id')
                ->relationship('officeSpace', 'name')
                ->searchable()
                ->preload()
                ->required(),

                TextInput::make('total_amount')
                ->numeric()->required()->maxLength(255)->prefix('Rp. ')->placeholder('123'),

                TextInput::make('duration')
                ->required()->numeric()->maxLength(255)->prefix('Hari'),

                DatePicker::make('started_at')->required(),
                DatePicker::make('ended_at')->required(),

                Select::make('is_paid')
                ->options([
                    true => 'Lunas',
                    false => 'Belum Lunas',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('booking_trx')->searchable(),
                TextColumn::make('phone_number')->searchable(),
                TextColumn::make('officeSpace.name'),
                TextColumn::make('total_amount'),
                TextColumn::make('duration'),

                IconColumn::make('is_paid')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Status')
                
            ])
            ->filters([
                //
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransactions::route('/create'),
            'edit' => Pages\EditBookingTransactions::route('/{record}/edit'),
        ];
    }

    public function setPhoneNumberAttribute($value)
    {
        // Hilangkan karakter "+" jika ada
        $formattedNumber = ltrim($value, '+');

        // Pastikan nomor dimulai dengan "62"
        if (str_starts_with($formattedNumber, '62')) {
            $this->attributes['phone_number'] = $formattedNumber;
        } else {
            $this->attributes['phone_number'] = '62' . $formattedNumber;
        }
    }
}
