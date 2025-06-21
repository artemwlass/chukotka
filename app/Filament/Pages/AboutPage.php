<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AboutPage extends Page
{
    protected static ?string $navigationGroup = 'Страницы сайта';
    protected static ?string $pluralModelLabel = 'О нас';
    protected static ?string $title = 'О нас';
    protected static ?string $navigationLabel = 'О нас';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.about-page';

    public ?array $data = [];

    public function mount(): void
    {
        $data = \App\Models\AboutPage::first();

        if ($data) {
            $this->form->fill($data->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Русский язык')
                            ->schema([
                                Tabs::make('Tabs')
                                    ->tabs([
                                        Tabs\Tab::make('SEO')
                                            ->schema([
                                                TextInput::make('seo.ru.title')
                                                    ->label('Title'),
                                                TextInput::make('seo.ru.og_title')
                                                    ->label('Og:Title'),
                                                Textarea::make('seo.ru.description')
                                                    ->label('Description')
                                                    ->rows(5),
                                                Textarea::make('seo.ru.og_description')
                                                    ->label('Og:Description')
                                                    ->rows(5),
                                                TextInput::make('seo.ru.keywords')
                                                    ->label('Keywords'),
                                                TextInput::make('seo.ru.og_type')
                                                    ->label('Og:Type'),
                                                TextInput::make('seo.ru.og_url')
                                                    ->label('Og:Url')
                                                    ->columnSpanFull(),
                                                FileUpload::make('seo.ru.og_image')
                                                    ->label('Og:Image')
                                                    ->columnSpanFull()
                                                    ->directory('seo')
                                            ])->columns(2),
                                        Tabs\Tab::make('Шапка')
                                            ->schema([
                                                TextInput::make('title.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                FileUpload::make('image')
                                                    ->required()
                                                    ->optimize('webp')
                                                    ->label('Изображение')
                                                    ->columnSpanFull(),
                                                RichEditor::make('header_description.ru.description')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Описание в шапке')
                                            ])->columns(2),
                                        Tabs\Tab::make('Основные')
                                            ->schema([
                                                TextInput::make('title_2.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                Textarea::make('first_block.ru.description')
                                                    ->required()
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                Textarea::make('two_block.ru.description')
                                                    ->required()
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                Textarea::make('three_block.ru.description')
                                                    ->required()
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                Textarea::make('four_block.ru.description')
                                                    ->required()
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                TextInput::make('title_2.ru.title_2')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок 2'),
                                                RichEditor::make('description.ru.description')
                                                    ->label('Контент')
                                                    ->columnSpanFull()
                                                    ->required(),
                                                Grid::make()
                                                    ->schema([
                                                        FileUpload::make('big_image')
                                                            ->required()
                                                            ->label('Большое изображение'),
                                                        FileUpload::make('small_image')
                                                            ->required()
                                                            ->label('Маленькое изображение'),
                                                    ])->columns(2),

                                            ])->columns(4),
                                        Tabs\Tab::make('Партнеры')
                                            ->schema([
                                                TextInput::make('partner.ru.title')
                                                    ->required()
                                                    ->label('Текст'),
                                                RichEditor::make('partner.ru.description')
                                                    ->required()
                                                    ->label('Описание в окне'),
                                                Textarea::make('partner.ru.text')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Текст'),
                                                Repeater::make('partner.images')
                                                    ->hiddenLabel()
                                                    ->label('логотипам')
                                                    ->schema([
                                                        FileUpload::make('logo')
                                                            ->required()
                                                            ->label('Логотип')
                                                    ])
                                                    ->grid(2), // Задает две колонки внутри репитера
                                            ]),
                                        Tabs\Tab::make('Карточка организации')
                                            ->schema([
                                                Repeater::make('card_organization.ru.card')
                                                    ->hiddenLabel()
                                                    ->label('карточке строку')
                                                    ->columnSpanFull()
                                                    ->schema([
                                                        TextInput::make('title')->required()->label('Ключ'),
                                                        TextInput::make('description')->required()->label('Значение'),

                                                    ])->columns(2),
                                            ])
                                    ]),
                            ]),
                        Tabs\Tab::make('Английский язык')
                            ->schema([
                                Tabs::make('Tabs')
                                    ->tabs([
                                        Tabs\Tab::make('SEO')
                                        ->schema([
                                            TextInput::make('seo.en.title')
                                                ->label('Title'),
                                            TextInput::make('seo.en.og_title')
                                                ->label('Og:Title'),
                                            Textarea::make('seo.en.description')
                                                ->label('Description')
                                                ->rows(5),
                                            Textarea::make('seo.en.og_description')
                                                ->label('Og:Description')
                                                ->rows(5),
                                            TextInput::make('seo.en.keywords')
                                                ->label('Keywords'),
                                            TextInput::make('seo.en.og_type')
                                                ->label('Og:Type'),
                                            TextInput::make('seo.en.og_url')
                                                ->label('Og:Url')
                                                ->columnSpanFull(),
                                            FileUpload::make('seo.en.og_image')
                                                ->label('Og:Image')
                                                ->columnSpanFull()
                                                ->directory('seo')
                                        ])->columns(2),
                                        Tabs\Tab::make('Шапка')
                                            ->schema([
                                                TextInput::make('title.en.title')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                FileUpload::make('image')
                                                    ->label('Изображение')
                                                    ->columnSpanFull(),
                                                RichEditor::make('header_description.en.description')
                                                    ->columnSpanFull()
                                                    ->label('Описание в шапке')
                                            ])->columns(2),
                                        Tabs\Tab::make('Основные')
                                            ->schema([
                                                TextInput::make('title_2.en.title')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                Textarea::make('first_block.en.description')
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                Textarea::make('two_block.en.description')
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                Textarea::make('three_block.en.description')
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                Textarea::make('four_block.en.description')
                                                    ->rows(5)
                                                    ->hiddenLabel(),
                                                TextInput::make('title_2.en.title_2')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок 2'),
                                                RichEditor::make('description.en.description')
                                                    ->label('Контент')
                                                    ->columnSpanFull(),
                                                Grid::make()
                                                    ->schema([
                                                        FileUpload::make('big_image')
                                                            ->required()
                                                            ->label('Большое изображение'),
                                                        FileUpload::make('small_image')
                                                            ->required()
                                                            ->label('Маленькое изображение'),
                                                    ])->columns(2),

                                            ])->columns(4),
                                        Tabs\Tab::make('Партнеры')
                                            ->schema([
                                                TextInput::make('partner.en.title')
                                                    ->label('Текст'),
                                                RichEditor::make('partner.en.description')
                                                    ->label('Описание в окне'),
                                                Textarea::make('partner.en.text')
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Текст'),
                                                Repeater::make('partner.images')
                                                    ->columnSpanFull()
                                                    ->hiddenLabel()
                                                    ->label('логотипам')
                                                    ->schema([
                                                        FileUpload::make('logo')
                                                            ->required()
                                                            ->label('Логотип'),
                                                    ])
                                            ]),
                                        Tabs\Tab::make('Карточка организации')
                                            ->schema([
                                                Repeater::make('card_organization.en.card')
                                                    ->hiddenLabel()
                                                    ->label('карточке строку')
                                                    ->columnSpanFull()
                                                    ->schema([
                                                        TextInput::make('title')->label('Ключ'),
                                                        TextInput::make('description')->label('Значение'),

                                                    ])->columns(2),
                                            ])
                                    ]),
                            ]),

                    ])
            ])->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = \App\Models\AboutPage::first();
        if ($record) {
            $record->update($data);
        } else {
            \App\Models\AboutPage::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
}
