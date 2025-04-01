<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Widgets\NoTimeToSearch;
use App\Filament\Pages\Widgets\PersonalTour;
use App\Filament\Pages\Widgets\ReservationTours;
use App\Models\ExcelKey;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class Applications extends Page
{
    protected static ?string $pluralModelLabel = 'Заявки с форм';
    protected static ?string $title = 'Заявки с форм';
    protected static ?string $navigationLabel = 'Заявки с форм';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.applications';

    public ?array $data = [];

    public function mount(): void
    {
        $data = ExcelKey::first();

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
            TextInput::make('key')
                ->label('Ключ таблицы Google Sheet')
                ->placeholder('Введите ключ...')
                ->required(),
            ])->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();
        $record = ExcelKey::first();
        if ($record) {
            $record->update($data);
        } else {
            ExcelKey::create($data);
        }
        Notification::make()
            ->title('Данные сохранены')
            ->success()
            ->send();
    }
    protected function getFooterWidgets(): array
    {
        return [
            NoTimeToSearch::class,
            PersonalTour::class,
            ReservationTours::class,
        ];
    }
}
