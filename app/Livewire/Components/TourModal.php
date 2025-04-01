<?php

namespace App\Livewire\Components;

use App\Models\PersonalTour;
use App\Models\User;
use App\Notifications\PersonalTourNotification;
use App\Services\GoogleSheetSevice;
use Livewire\Component;

class TourModal extends Component
{
    public $name;
    public $email;
    public $phone;
    public $comment;
    public $agree;

    public function store()
    {

        $this->validate([
            'phone' => 'required|string',
            'agree' => 'accepted',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'comment' => 'nullable|string',
        ], [
            'phone.required' => __('Поле "Контактный телефон" обязательно для заполнения.'),
            'agree.accepted' => __('Вы должны согласиться с условиями политики конфиденциальности.'),
        ]);

        $order = PersonalTour::create([
            'name' => $this->name ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone,
            'comment' => $this->comment ?? '',
            'agree' => $this->agree,
        ]);

        $this->reset(['name', 'email', 'phone', 'comment', 'agree']);

        $user = User::first();-
        $user->notify(new PersonalTourNotification($order));

        $this->dispatch('open-thank-modal');

        $sheet = new GoogleSheetSevice($order->id,'Заявка с формы- персональный тур');
        $sheet->addToSheet();
    }

    public function render()
    {
        return view('livewire.components.tour-modal');
    }
}
