<?php

namespace App\Livewire;

use App\Models\TourPage;
use App\Traits\HandlesSeo;
use Livewire\Component;

class Tours extends Component
{
    use HandlesSeo;

    public $data;

    public function mount()
    {
        $this->data = TourPage::first();
        $this->setSeo($this->data);
    }

    public function render()
    {
        return view('livewire.tours');
    }
}
