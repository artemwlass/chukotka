<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Filament\Resources\TourResource\RelationManagers;
use App\Models\Tour;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TourResource extends Resource
{
    use Translatable;

    protected static ?string $model = Tour::class;
    protected static ?string $modelLabel = 'Туры';
    protected static ?string $pluralModelLabel = 'Туры';
    protected static ?string $navigationGroup = 'Туры';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('SEO')
                            ->schema([
                                TextInput::make('seo.title')
                                    ->label('Title'),
                                TextInput::make('seo.keywords')
                                    ->label('Keywords'),
                                Textarea::make('seo.description')
                                    ->label('Description')
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Tabs\Tab::make('Основные')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->label('Заголовок')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->label('URL'),
                                Select::make('type_logo')
                                    ->options([
                                        'image' => 'Изображение',
                                        'blue' => 'Синий градиент',
                                        'orange' => 'Оранжевый градиент',
                                    ])
                                    ->required()
                                    ->label('Выберите тип изображения'),
                                FileUpload::make('main_image')
                                    ->label('Изображение')
                                    ->columnSpanFull()
                                    ->optimize('webp')
                                    ->required(),
                                TextInput::make('tour_duration')
                                    ->required()
                                    ->integer()
                                    ->label('Длительность тура'),
                                TextInput::make('price')
                                    ->required()
                                    ->label('Прайс'),
                                Forms\Components\Repeater::make('tour_specifications')
                                    ->label('Спецификация тура')
                                    ->columnSpanFull()
                                    ->schema([
                                        TextInput::make('question')->required()->label('Вопрос'),
                                        TextInput::make('answer')->required()->label('Ответ'),
                                    ])->columns(2)


                            ])->columns(2),
                        Tabs\Tab::make('О туре')
                            ->schema([
                                TextInput::make('title_1')
                                    ->required()
                                    ->label('Заголовок'),
                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->hiddenLabel(),
                                FileUpload::make('images')
                                    ->label('Изображения')
                                    ->multiple()
                                    ->optimize('webp')
                                    ->columnSpanFull()
                                    ->required(),
                                FileUpload::make('link_video')
                                    ->columnSpanFull()
                                    ->directory('film')
                                    ->label('Видео'),
                            ]),
                        Tabs\Tab::make('Галерея')
                            ->schema([
                                FileUpload::make('galleries')
                                    ->label('Изображения')
                                    ->multiple()
                                    ->optimize('webp')
                                    ->columnSpanFull()
                                    ->required(),
                            ]),
                        Tabs\Tab::make('Особенности программы')
                            ->schema([
                                Forms\Components\Repeater::make('program_capabilities')
                                    ->label('Спецификация тура')
                                    ->columnSpanFull()
                                    ->schema([
                                        TextInput::make('description')->required()->label('Описание'),
                                    ])
                            ]),
                        Tabs\Tab::make('Что присутствует в туре')
                            ->schema([
                                Forms\Components\Repeater::make('awaits')
                                    ->hiddenLabel()
                                    ->columnSpanFull()
                                    ->schema([
                                        TextInput::make('description')->required()->label('Описание'),
                                    ])
                            ]),
                        Tabs\Tab::make('Что взять с собой')
                            ->schema([
                                Forms\Components\Repeater::make('take.necessarily')
                                    ->hiddenLabel()
                                    ->label('обязательно')
                                    ->schema([
                                        TextInput::make('description')->required()->label('Описание'),
                                        Forms\Components\Toggle::make('is_active')->label('Обязательно')
                                    ]),
                                Forms\Components\Repeater::make('take.necessarily_2')
                                    ->hiddenLabel()
                                    ->label('обязательно')
                                    ->schema([
                                        TextInput::make('description')->required()->label('Описание'),
                                        Forms\Components\Toggle::make('is_active')->label('Обязательно')
                                    ]),
                                Forms\Components\Repeater::make('take.preferably')
                                    ->hiddenLabel()
                                    ->label('желательно')
                                    ->schema([
                                        TextInput::make('description')->required()->label('Описание'),
                                        Forms\Components\Toggle::make('is_active')->label('Обязательно')
                                    ]),
                                Forms\Components\Repeater::make('take.we_provide')
                                    ->hiddenLabel()
                                    ->label('мы предоставляем')
                                    ->schema([
                                        TextInput::make('description')->required()->label('Описание'),
                                    ]),
                                FileUpload::make('take.pdf')->label('Программа в pdf')->columnSpanFull(),
                            ])->columns(4),

                        Tabs\Tab::make('Блоки с основной информацией')
                            ->schema([
                                TextInput::make('first_small_block.title')
                                    ->required()
                                    ->label('Заголовок'),
                                TextInput::make('two_small_block.title')
                                    ->required()
                                    ->label('Заголовок'),
                                TextInput::make('three_small_block.title')
                                    ->required()
                                    ->label('Заголовок'),
                                Forms\Components\Textarea::make('first_small_block.description')
                                    ->required()
                                    ->rows(5)
                                    ->hiddenLabel(),
                                Forms\Components\Textarea::make('two_small_block.description')
                                    ->required()
                                    ->rows(5)
                                    ->hiddenLabel(),
                                Forms\Components\Textarea::make('three_small_block.description')
                                    ->required()
                                    ->rows(5)
                                    ->hiddenLabel(),
                                Forms\Components\TextInput::make('big_block.title')
                                    ->required()
                                    ->columnSpanFull()
                                    ->hiddenLabel(),
                                Forms\Components\RichEditor::make('big_block.description')
                                    ->required()
                                    ->columnSpanFull()
                                    ->hiddenLabel(),
                            ])->columns(3),
                        Tabs\Tab::make('Что входит/не входит в стоимость')
                            ->schema([
                                Forms\Components\RichEditor::make('include.include')
                                    ->required()
                                    ->label('Что входит в стоимость'),
                                Forms\Components\RichEditor::make('include.not_include')
                                    ->required()
                                    ->label('Что не входит в стоимость'),
                            ])->columns(2),
                        Tabs\Tab::make('Карта и рекомендации')
                            ->schema([
                                TextInput::make('map_link')
                                    ->required()
                                    ->label('Карта'),
                                Select::make('recommend.1')
                                    ->hiddenLabel()
                                    ->options(Tour::all()->pluck('title', 'id')),
                                Select::make('recommend.2')
                                    ->hiddenLabel()
                                    ->options(Tour::all()->pluck('title', 'id')),
                                Select::make('recommend.3')
                                    ->hiddenLabel()
                                    ->options(Tour::all()->pluck('title', 'id')),
                            ]),
                    ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Тур')->searchable(),
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
            RelationManagers\DaysRelationManager::class,
            RelationManagers\BookingsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
