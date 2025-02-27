<?php

namespace App\Livewire\Components;

use App\Models\PersonalTour;
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

        PersonalTour::create([
            'name' => $this->name ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone,
            'comment' => $this->comment ?? '',
            'agree' => $this->agree,
        ]);

        $this->reset(['name', 'email', 'phone', 'comment', 'agree']);

        $this->dispatch('open-thank-modal');
    }

    public function render()
    {
        return view('livewire.components.tour-modal');
    }
}
