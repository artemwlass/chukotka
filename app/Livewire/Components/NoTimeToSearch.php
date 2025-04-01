<?php

namespace App\Livewire\Components;

use App\Models\User;
use App\Notifications\OrderAdminTelegram;
use App\Notifications\OrderToTelegramNotification;
use App\Services\GoogleSheetSevice;
use Livewire\Component;

class NoTimeToSearch extends Component
{
    public $name;
    public $phone;
    public $agree = false;

    protected $rules = [
        'name' => 'required|string',
        'phone' => 'required|string',
        'agree' => 'accepted'
    ];

    protected $messages = [
        'name.required' => 'Поле "Имя" обязательно для заполнения.',
        'phone.required' => 'Поле "Телефон" обязательно для заполнения.',
        'agree.accepted' => 'Вы должны согласиться с условиями.'
    ];

    public function create()
    {
        $this->validate();

        $order = \App\Models\NoTimeToSearch::create([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        $this->reset(['name', 'phone', 'agree']);

        $user = User::first();
        $user->notify(new OrderToTelegramNotification($order));

        $this->dispatch('open-thank-modal');

        $sheet = new GoogleSheetSevice($order->id,'Заявка с формы- нет времени на поиск');
        $sheet->addToSheet();
    }
    public function render()
    {
        return view('livewire.components.no-time-to-search');
    }
}
