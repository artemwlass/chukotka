<?php

namespace App\Livewire;

use App\Models\AboutPage;
use App\Traits\HandlesSeo;
use Livewire\Component;

class About extends Component
{
    use HandlesSeo;

    public $data;

    public function mount()
    {
        $this->data = AboutPage::first();
        $this->setSeo($this->data);
    }
    public function render()
    {
        return view('livewire.about');
    }
}
