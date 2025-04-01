<?php

namespace App\Filament\Resources\TourResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Attributes\Reactive;

class DaysRelationManager extends RelationManager
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;
    protected static string $relationship = 'days';

    protected static ?string $title = 'Дни';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('day')
                            ->label('День')
                            ->prefix('День')
                            ->required()
                            ->integer()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->label('Текст')
                            ->columnSpanFull(),
                        Forms\Components\Checkbox::make('program_capabilities.see_more')
                            ->label('Кнопка смотреть еще')
                            ->columnSpanFull()
                            ->live(),
                        Forms\Components\RichEditor::make('program_capabilities.description')
                            ->label('Текст')
                            ->columnSpanFull()
                            ->visible(fn(Forms\Get $get) => ($get('program_capabilities.see_more') == '1')),
                        Forms\Components\Repeater::make('program_capabilities.capabilities')
                            ->label('Свойства')
                            ->columnSpanFull()
                            ->schema([
                                Forms\Components\FileUpload::make('icon')->required()->label('Иконка'),
                                Forms\Components\Select::make('color')->required()->label('Цвет')->options([
                                   'rgba(109, 109, 109, 0.1)' => 'Неактивный',
                                   'rgba(2, 82, 221, 0.1)' => 'Активный',
                                ]),
                                TextInput::make('title')->required()->label('Текст')
                            ])

                    ])->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('day')
            ->columns([
                Tables\Columns\TextColumn::make('day')
                ->label('День')
                ->suffix(' день'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\LocaleSwitcher::make()
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
