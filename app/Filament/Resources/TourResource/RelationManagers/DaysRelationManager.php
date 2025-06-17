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

//    #[Reactive]
    public ?string $activeLocale = null;
    protected static string $relationship = 'days';

    protected static ?string $title = 'Дни';

    public function form(Form $form): Form
    {
        $iconOptions = [
            'program-card-icon-1.svg' => "<img src=\"" . asset('program-card/program-card-icon-1.svg') . "\" alt=\"Program Card Icon 1\" class=\"w-6 h-6\">",
            'program-card-icon-2.svg' => "<img src=\"" . asset('program-card/program-card-icon-2.svg') . "\" alt=\"Program Card Icon 2\" class=\"w-6 h-6\">",
            'program-card-icon-3.svg' => "<img src=\"" . asset('program-card/program-card-icon-3.svg') . "\" alt=\"Program Card Icon 3\" class=\"w-6 h-6\">",
            'program-card-icon-4.svg' => "<img src=\"" . asset('program-card/program-card-icon-4.svg') . "\" alt=\"Program Card Icon 4\" class=\"w-6 h-6\">",
            'program-card-icon-5.svg' => "<img src=\"" . asset('program-card/program-card-icon-5.svg') . "\" alt=\"Program Card Icon 4\" class=\"w-6 h-6\">",
            'program-card-icon-6.svg' => "<img src=\"" . asset('program-card/program-card-icon-6.svg') . "\" alt=\"Program Card Icon 4\" class=\"w-6 h-6\">",
            'program-card-icon-7.svg' => "<img src=\"" . asset('program-card/program-card-icon-7.svg') . "\" alt=\"Program Card Icon 4\" class=\"w-6 h-6\">",
            'program-card-icon-8.svg' => "<img src=\"" . asset('program-card/program-card-icon-8.svg') . "\" alt=\"Program Card Icon 4\" class=\"w-6 h-6\">",
        ];

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
                                Forms\Components\Select::make('icon')
                                    ->label('Иконка')
                                    ->options($iconOptions)
                                    ->required()
                                    ->searchable()
                                    ->allowHtml(),
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
