<?php

namespace App\Filament\Resources\TourResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';
    protected static ?string $title = 'Даты бронирования';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\DatePicker::make('date_from')
                        ->required()
                        ->label('Дата начала'),
                    Forms\Components\DatePicker::make('date_to')
                        ->required()
                        ->label('Дата завершения'),
                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->columnSpanFull()
                        ->label('Прайс')
                        ->maxLength(255),
                ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('price')
            ->columns([
                Tables\Columns\TextColumn::make('date_from')
                    ->date()
                    ->label('Дата начала'),
                Tables\Columns\TextColumn::make('date_to')
                    ->date()
                    ->label('Дата завершения'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Прайс'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
