<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Tours extends Component
{
    public $tours;

    public function mount()
    {
        $this->tours = \App\Models\Tour::where('is_active', true)->with('bookings')->get();

    }
    public function render()
    {
        return view('livewire.components.tours');
    }
}
