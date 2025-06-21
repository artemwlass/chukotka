<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class BlogPage extends Page
{
    protected static ?string $navigationGroup = 'Страницы сайта';
    protected static ?string $pluralModelLabel = 'Блог';
    protected static ?string $title = 'Блог';
    protected static ?string $navigationLabel = 'Блог';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.blog-page';

    public ?array $data = [];

    public function mount(): void
    {
        $data = \App\Models\BlogPage::first();

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
                                        Tabs\Tab::make('Заголовок')
                                            ->schema([
                                                TextInput::make('title.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
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
                                        Tabs\Tab::make('Заголовок')
                                            ->schema([
                                                TextInput::make('title.en.title')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                            ])->columns(2),
                                    ]),
                            ]),

                    ])
            ])->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = \App\Models\BlogPage::first();
        if ($record) {
            $record->update($data);
        } else {
            \App\Models\BlogPage::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
}
