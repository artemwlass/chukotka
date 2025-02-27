<?php

namespace App\Livewire\Components;

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

        \App\Models\NoTimeToSearch::create([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        $this->reset(['name', 'phone', 'agree']);

        $this->dispatch('open-thank-modal');
    }
    public function render()
    {
        return view('livewire.components.no-time-to-search');
    }
}
