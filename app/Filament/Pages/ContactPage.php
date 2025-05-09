<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactPage extends Page
{
    protected static ?string $navigationGroup = 'Страницы сайта';
    protected static ?string $pluralModelLabel = 'Контакты';
    protected static ?string $title = 'Контакты';
    protected static ?string $navigationLabel = 'Контакты';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.contact-page';

    public ?array $data = [];

    public function mount(): void
    {
        $data = \App\Models\ContactPage::first();

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
                                                TextInput::make('seo.ru.keywords')
                                                    ->label('Keywords'),
                                                Textarea::make('seo.ru.description')
                                                    ->label('Description')
                                                    ->rows(5)
                                                    ->columnSpanFull(),
                                            ])->columns(2),
                                        Tabs\Tab::make('Основная информация')
                                            ->schema([
                                                TextInput::make('content.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                TextInput::make('content.phone')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Телефон'),
                                                TextInput::make('content.email')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Email'),
                                                TextInput::make('content.address')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Адрес'),
                                                Textarea::make('content.map')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Карта')
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
                                                TextInput::make('seo.en.keywords')
                                                    ->label('Keywords'),
                                                Textarea::make('seo.en.description')
                                                    ->label('Description')
                                                    ->rows(5)
                                                    ->columnSpanFull(),
                                            ])->columns(2),
                                        Tabs\Tab::make('Основная информация')
                                            ->schema([
                                                TextInput::make('content.en.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                TextInput::make('content.phone')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Телефон'),
                                                TextInput::make('content.email')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Email'),
                                                TextInput::make('content.address')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Адрес'),
                                                Textarea::make('content.map')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Карта')
                                            ])->columns(2),
                                    ]),
                            ]),

                    ])
            ])->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = \App\Models\ContactPage::first();
        if ($record) {
            $record->update($data);
        } else {
            \App\Models\ContactPage::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
}
