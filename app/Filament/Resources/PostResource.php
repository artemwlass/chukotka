<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
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
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;
    protected static ?string $modelLabel = 'Статья';
    protected static ?string $pluralModelLabel = 'Статьи';
    protected static ?string $navigationGroup = 'Блог';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('seo.title')
                                    ->label('Title'),
                                Forms\Components\TextInput::make('seo.og_title')
                                    ->label('Og:Title'),
                                Forms\Components\Textarea::make('seo.description')
                                    ->label('Description')
                                    ->rows(5),
                                Forms\Components\Textarea::make('seo.og_description')
                                    ->label('Og:Description')
                                    ->rows(5),
                                Forms\Components\TextInput::make('seo.keywords')
                                    ->label('Keywords'),
                                Forms\Components\TextInput::make('seo.og_type')
                                    ->label('Og:Type'),
                                Forms\Components\TextInput::make('seo.og_url')
                                    ->label('Og:Url')
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('seo.og_image')
                                    ->label('Og:Image')
                                    ->columnSpanFull()
                                    ->directory('seo')
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
                                FileUpload::make('image')
                                    ->label('Изображение')
                                    ->columnSpanFull()
                                    ->optimize('webp')
                                    ->required(),
                                TextInput::make('author')
                                    ->required()
                                    ->label('Автор'),
                                Forms\Components\Repeater::make('tags')
                                    ->label('Тэги')
                                    ->columnSpanFull()
                                    ->schema([
                                        TextInput::make('title')->required()->label('Текст'),
                                        Select::make('color')->required()->label('Цвет')->options([
                                            'alerts-green' => 'Зеленый',
                                            'alerts-red' => 'Красный',
                                            'alerts-blue' => 'Синий',
                                            'alerts-orange' => 'Оранжевый',
                                            'alerts-lightblue' => 'Голубой',
                                        ])
                                    ])->columns(2)
                            ])->columns(2),
                        Tabs\Tab::make('Контент')
                            ->schema([
                                TiptapEditor::make('description')
                                    ->hiddenLabel()
                                    ->profile('default')
                                    ->output(TiptapOutput::Html)
                                    ->maxSize(15360)
                                    ->maxContentWidth('5xl')
                                    ->required(),
                                Select::make('recommendation_tour_id')->label('Рекомендованный тур')
                                    ->options(Tour::where('is_active', true)->pluck('title', 'id')),
                                TiptapEditor::make('description_2')
                                    ->hiddenLabel()
                                    ->profile('default')
                                    ->output(TiptapOutput::Html)
                                    ->maxSize(15360)
                                    ->maxContentWidth('5xl')
                                    ->required(),
                            ]),
                        Tabs\Tab::make('Рекомендуемые туры')
                            ->schema([
                                Select::make('recommend.1')
                                    ->hiddenLabel()
                                    ->options(Tour::where('is_active', true)->pluck('title', 'id')),
                                Select::make('recommend.2')
                                    ->hiddenLabel()
                                    ->options(Tour::where('is_active', true)->pluck('title', 'id')),
                                Select::make('recommend.3')
                                    ->hiddenLabel()
                                    ->options(Tour::where('is_active', true)->pluck('title', 'id')),
                            ]),
                    ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Заголовок')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
