<?php

namespace App\Livewire\Components;

use App\Models\Day;
use App\Models\Tour;
use Livewire\Attributes\On;
use Livewire\Component;

class DayModal extends Component
{
    public $data;

    public function resetDay()
    {
        $this->data = null;
    }
    #[On('openDayModal')]
    public function getDay($dayId)
    {
        $this->resetDay();
        $this->data = Day::find($dayId);
    }
    public function render()
    {
        return view('livewire.components.day-modal');
    }
}
