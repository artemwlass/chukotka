<?php

namespace App\Filament\Pages;

use App\Models\AboutPage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class HeaderAndFooter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.header-and-foter';

    public ?array $data = [];

    public function mount(): void
    {
        $data = \App\Models\HeaderAndFooter::first();

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
                                        Tabs\Tab::make('Header')
                                            ->schema([
//                                                TextInput::make('header.ru.logo')
//                                                    ->required()
//                                                    ->label('Название сайта'),
                                                FileUpload::make('header.ru.logo1')
                                                    ->required()
                                                    ->label('Лого'),
                                                FileUpload::make('header.ru.logo2')
                                                    ->required()
                                                    ->label('Лого'),
                                                Repeater::make('header.ru.link')
                                                    ->label('Меню')
                                                    ->schema([
                                                        TextInput::make('name')
                                                            ->required()
                                                            ->label('Название'),
                                                        TextInput::make('link')
                                                            ->required()
                                                            ->label('Ссылка')
                                                    ]),
                                                Repeater::make('header.ru.social')
                                                    ->label('Соц. сети')
                                                    ->schema([
                                                        Textarea::make('logo')
                                                            ->required()
                                                            ->rows(5)
                                                            ->label('Лого svg'),
                                                        TextInput::make('link')
                                                            ->required()
                                                            ->label('Ссылка')
                                                    ]),
                                            ]),
                                        Tabs\Tab::make('Footer')
                                            ->schema([
                                                FileUpload::make('footer.ru.logo')
                                                    ->required()
                                                    ->label('Лого'),
                                                Repeater::make('footer.ru.logos')
                                                    ->label('Логотипы')
                                                    ->schema([
                                                        FileUpload::make('logo')
                                                            ->required()
                                                            ->label('Лого'),
                                                    ])->columnSpanFull(),

                                                TextInput::make('footer.ru.address')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Юр. адрес заголовок'),
                                                Textarea::make('footer.ru.address_description')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Адрес'),
                                                TextInput::make('footer.ru.time')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Время работы заголовок'),
                                                Textarea::make('footer.ru.time_description')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Время работы'),
                                                TextInput::make('footer.ru.phone')
                                                    ->required()
                                                    ->label('Телефон'),
                                                TextInput::make('footer.ru.email')
                                                    ->required()
                                                    ->label('Email'),
//                                                TextInput::make('footer.ru.under_footer_title_1')
//                                                    ->required()
//                                                    ->label('Текст под футером'),
//                                                TextInput::make('footer.ru.under_footer_link_1')
//                                                    ->required()
//                                                    ->label('Ссылка под футером'),
//                                                TextInput::make('footer.ru.under_footer_title_2')
//                                                    ->required()
//                                                    ->label('Текст под футером'),
//                                                TextInput::make('footer.ru.under_footer_link_2')
//                                                    ->required()
//                                                    ->label('Ссылка под футером'),
                                            ])->columns(2),
                                    ]),
                            ]),
                        Tabs\Tab::make('Английский язык')
                            ->schema([
                                Tabs::make('Tabs')
                                    ->tabs([
                                        Tabs\Tab::make('Header')
                                            ->schema([
                                                FileUpload::make('header.en.logo1')
                                                    ->label('Лого'),
                                                FileUpload::make('header.en.logo2')
                                                    ->label('Лого'),
                                                Repeater::make('header.en.link')
                                                    ->label('Меню')
                                                    ->schema([
                                                        TextInput::make('name')
                                                            ->required()
                                                            ->label('Название'),
                                                        TextInput::make('link')
                                                            ->required()
                                                            ->label('Ссылка')
                                                    ]),
                                                Repeater::make('header.en.social')
                                                    ->label('Соц. сети')
                                                    ->schema([
                                                        Textarea::make('logo')
                                                            ->required()
                                                            ->rows(5)
                                                            ->label('Лого svg'),
                                                        TextInput::make('link')
                                                            ->required()
                                                            ->label('Ссылка')
                                                    ]),
                                            ]),
                                        Tabs\Tab::make('Footer')
                                            ->schema([

                                                FileUpload::make('footer.en.logo')
                                                    ->label('Лого'),
                                                Repeater::make('footer.en.logos')
                                                    ->label('Логотипы банков')
                                                    ->schema([
                                                        FileUpload::make('logo')
                                                            ->required()
                                                            ->label('Лого'),
                                                    ])->columnSpanFull(),

                                                TextInput::make('footer.en.address')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Юр. адрес заголовок'),
                                                Textarea::make('footer.en.address_description')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Адрес'),
                                                TextInput::make('footer.en.time')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->label('Время работы заголовок'),
                                                Textarea::make('footer.en.time_description')
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->rows(5)
                                                    ->label('Время работы'),
                                                TextInput::make('footer.en.phone')
                                                    ->required()
                                                    ->label('Телефон'),
                                                TextInput::make('footer.en.email')
                                                    ->required()
                                                    ->label('Email'),
//                                                TextInput::make('footer.en.under_footer_title_1')
//                                                    ->required()
//                                                    ->label('Текст под футером'),
//                                                TextInput::make('footer.en.under_footer_link_1')
//                                                    ->required()
//                                                    ->label('Ссылка под футером'),
//                                                TextInput::make('footer.en.under_footer_title_2')
//                                                    ->required()
//                                                    ->label('Текст под футером'),
//                                                TextInput::make('footer.en.under_footer_link_2')
//                                                    ->required()
//                                                    ->label('Ссылка под футером'),
                                            ])->columns(2),
                                    ]),
                            ]),

                    ])
            ])->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $record = \App\Models\HeaderAndFooter::first();
        if ($record) {
            $record->update($data);
        } else {
            \App\Models\HeaderAndFooter::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
}
