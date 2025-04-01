<?php

namespace App\Livewire\Components;

use App\Models\Day;
use App\Models\Tour;
use Livewire\Attributes\On;
use Livewire\Component;

class DayModal extends Component
{
    public $data;
    #[On('openDayModal')]
    public function getDay($dayId)
    {
        $this->data = Day::find($dayId);
    }
    public function render()
    {
        return view('livewire.components.day-modal');
    }
}
