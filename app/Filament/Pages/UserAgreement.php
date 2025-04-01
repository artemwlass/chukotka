<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class UserAgreement extends Page
{
    protected static ?string $navigationGroup = 'Страницы сайта';
    protected static ?string $pluralModelLabel = 'Пользовательское соглашение об обработке';
    protected static ?string $title = 'Пользовательское соглашение об обработке';
    protected static ?string $navigationLabel = 'Пользовательское соглашение об обработке';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.user-agreement';
    public ?array $data = [];

    public function mount(): void
    {
        $data = \App\Models\UserAgreement::first();

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
                                        Tabs\Tab::make('Контент')
                                            ->schema([
                                                TextInput::make('title.ru.title')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                RichEditor::make('description.ru.description')
                                                    ->label('Текст')
                                                    ->columnSpanFull(),
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
                                        Tabs\Tab::make('Контент')
                                            ->schema([
                                                TextInput::make('title.en.title')
                                                    ->columnSpanFull()
                                                    ->label('Заголовок'),
                                                RichEditor::make('description.en.description')
                                                    ->label('Текст')
                                                    ->columnSpanFull(),
                                            ])->columns(2),
                                    ]),
                            ]),

                    ])
            ])->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = \App\Models\UserAgreement::first();
        if ($record) {
            $record->update($data);
        } else {
            \App\Models\UserAgreement::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
}
