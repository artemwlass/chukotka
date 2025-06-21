<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Index extends Page
{
    protected static ?string $navigationGroup = 'Страницы сайта';
    protected static ?string $pluralModelLabel = 'Главная';
    protected static ?string $title = 'Главная';
    protected static ?string $navigationLabel = 'Главная';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.index';

    public ?array $data = [];

    public function mount(): void
    {
        $data = \App\Models\Home::first();

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
                                                FileUpload::make('image_bg')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->optimize('webp')
                                                    ->label('Изображение'),
                                                TextInput::make('title.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                FileUpload::make('title.image')
                                                    ->required()
                                                    ->label('Иконка'),
                                                TextInput::make('title.ru.title2')
                                                    ->required()
                                                    ->label('Заголовок- продолжение'),
                                                Repeater::make('option.ru.options')
                                                    ->columnSpanFull()
                                                    ->schema([
                                                        FileUpload::make('icon')
                                                            ->required()
                                                            ->label('Иконка'),
                                                        TextInput::make('title')
                                                            ->required()
                                                            ->label('Текст'),
                                                    ])->columns(2),
                                            ])->columns(2),
                                        Tabs\Tab::make('Персональный тур')
                                            ->schema([
                                                TextInput::make('personal_tour.ru.title')
                                                    ->required()
                                                    ->label('Заголовок'),
                                                FileUpload::make('personal_tour.icon')
                                                    ->required()
                                                    ->label('Иконка'),
                                                TextInput::make('personal_tour.ru.title2')
                                                    ->required()
                                                    ->label('Заголовок- продолжение'),
                                                Textarea::make('personal_tour.ru.description')
                                                    ->required()
                                                    ->rows(5)
                                                    ->columnSpanFull()
                                                    ->label('Описание'),
                                                FileUpload::make('personal_tour.image')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Изображение ПК'),
                                                FileUpload::make('personal_tour.image_mob')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Изображение телефон'),
                                            ])->columns(3),
                                        Tabs\Tab::make('О компании')
                                            ->schema([
                                                TextInput::make('about_company.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                RichEditor::make('about_company.ru.description')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Текст'),
                                                FileUpload::make('about_company.image_big')
                                                    ->required()
                                                    ->label('Изображение'),
                                                FileUpload::make('about_company.image_small')
                                                    ->required()
                                                    ->label('Изображение'),
                                                Repeater::make('about_company.partner')
                                                    ->schema([
                                                        FileUpload::make('icon')
                                                            ->required()
                                                            ->label('Иконка')
                                                    ]),
                                                TextInput::make('about_company.ru.title_video')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок на видео'),
                                                FileUpload::make('about_company.title_video_link')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->directory('film')
                                                    ->label('Видео'),
                                                RichEditor::make('about_company.ru.title_video_description')
                                                    ->required()
                                                    ->label('Описание')
                                                    ->columnSpanFull()
                                            ])->columns(2),
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
                                                FileUpload::make('image_bg')
                                                    ->columnSpanFull()
                                                    ->optimize('webp')
                                                    ->label('Изображение'),
                                                TextInput::make('title.en.title')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                FileUpload::make('title.image')
                                                    ->label('Иконка'),
                                                TextInput::make('title.en.title2')
                                                    ->label('Заголовок- продолжение'),
                                                Repeater::make('option.en.options')
                                                    ->columnSpanFull()
                                                    ->schema([
                                                        FileUpload::make('icon')
                                                            ->label('Иконка'),
                                                        TextInput::make('title')
                                                            ->label('Текст'),
                                                    ])->columns(2),
                                            ])->columns(2),
                                        Tabs\Tab::make('Персональный тур')
                                            ->schema([
                                                TextInput::make('personal_tour.en.title')
                                                    ->label('Заголовок'),
                                                FileUpload::make('personal_tour.icon')
                                                    ->label('Иконка'),
                                                TextInput::make('personal_tour.en.title2')
                                                    ->label('Заголовок- продолжение'),
                                                Textarea::make('personal_tour.en.description')
                                                    ->rows(5)
                                                    ->columnSpanFull()
                                                    ->label('Описание'),
                                                FileUpload::make('personal_tour.image')
                                                    ->columnSpanFull()
                                                    ->label('Изображение'),
                                            ])->columns(3),
                                        Tabs\Tab::make('О компании')
                                            ->schema([
                                                TextInput::make('about_company.en.title')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                RichEditor::make('about_company.en.description')
                                                    ->columnSpanFull()
                                                    ->label('Текст'),
                                                FileUpload::make('about_company.image_big')
                                                    ->label('Изображение'),
                                                FileUpload::make('about_company.image_small')
                                                    ->label('Изображение'),
                                                Repeater::make('about_company.en.partner')
                                                    ->schema([
                                                        FileUpload::make('icon')
                                                            ->label('Иконка')
                                                    ]),
                                                TextInput::make('about_company.en.title_video')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок на видео'),
                                                FileUpload::make('about_company.title_video_link')
                                                    ->columnSpanFull()
                                                    ->directory('film')
                                                    ->label('Видео'),
                                                RichEditor::make('about_company.en.title_video_description')
                                                    ->label('Описание')
                                                    ->columnSpanFull()
                                            ])->columns(2),
                                    ]),
                            ]),

                    ])
            ])->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = \App\Models\Home::first();
        if ($record) {
            $record->update($data);
        } else {
            \App\Models\Home::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
}
